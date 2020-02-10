<?php
declare(strict_types=1);
namespace In2code\In2faq\Importer;

use Doctrine\DBAL\DBALException;
use In2code\In2faq\Importer\Helpers\AbstractHelper;
use In2code\In2faq\Importer\Helpers\HelperInterface;
use In2code\In2faq\Utility\DatabaseUtility;
use In2code\In2faq\Utility\ObjectUtility;

/**
 * Class AbstractImporter
 */
abstract class AbstractImporter implements ImporterInterface
{
    /**
     * Table from where to import
     *
     * @var string
     */
    protected $tableNameOld = '';

    /**
     * Table where to import
     *
     * @var string
     */
    protected $tableName = '';

    /**
     * Fields that should be imported by default in every table
     *  [
     *      'oldProperty' => 'newProperty'
     *  ]
     *
     * @var array
     */
    protected $defaultMapping = [
        'uid' => 'uid',
        'pid' => 'pid',
        'tstamp' => 'tstamp',
        'crdate' => 'cruser_id',
        'deleted' => 'deleted',
        'hidden' => 'hidden',
        'sys_language_uid' => 'sys_language_uid',
        'l18n_parent' => 'l10n_parent',
    ];

    /**
     * Field mapping
     *  [
     *      'oldProperty' => 'newProperty'
     *  ]
     *
     * @var array
     */
    protected $mapping = [];

    /**
     * Helper functions mapped on single fields
     *  [
     *      'newFieldName' => 'RemoveImageTagsHelper'
     *  ]
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * @var string
     */
    protected $helperPrefix = 'In2code\\In2faq\\Importer\\Helpers\\';

    /**
     * @var string
     */
    protected $helperInterface = HelperInterface::class;

    /**
     * @var bool
     */
    protected $truncateBeforeImport = true;

    /**
     * Import from irfaq
     *
     * @param bool $dryrun
     * @param int|null $forcePid Force import of all records to a pid
     * @return string
     * @throws \Exception
     */
    public function import($dryrun = false, $forcePid = null)
    {
        $rows = $this->getOldRows();
        if (!$dryrun) {
            $this->truncateTable();
            foreach ($rows as $row) {
                $this->importRow($row, $forcePid);
            }
            $message = count($rows) . ' records imported to table ' . $this->tableName;
        } else {
            $message = count($rows) . ' records could be imported to table ' . $this->tableName;
        }
        return $message;
    }

    /**
     * @return array
     */
    protected function getOldRows()
    {
        $queryBuilder = DatabaseUtility::getQueryBuilderForTable($this->tableNameOld);
        return (array)$queryBuilder
            ->select('*')
            ->from($this->tableNameOld)
            ->where('uid > 0')
            ->execute()
            ->fetchAll();
    }

    /**
     * @param array $row
     * @param int|null $forcePid Force import of all records to a pid
     * @throws \Exception
     */
    protected function importRow(array $row, $forcePid)
    {
        $connection = DatabaseUtility::getConnectionForTable($this->tableName);
        $connection->insert($this->tableName, $this->getFieldArray($row, $forcePid));
    }

    /**
     * @param array $row
     * @param int|null $forcePid Force import of all records to a pid
     * @return array
     * @throws \Exception
     */
    protected function getFieldArray(array $row, $forcePid)
    {
        $fieldArray = [];
        foreach ($this->getMapping() as $oldProperty => $newProperty) {
            if (array_key_exists($oldProperty, $row) && $this->isFieldExistingInNewTable($newProperty)) {
                $fieldArray[$newProperty] = $row[$oldProperty];
            }
        }
        if ($forcePid !== null && $this->isFieldExistingInNewTable('pid')) {
            $fieldArray['pid'] = $forcePid;
        }
        $fieldArray = $this->parseArrayByHelpers($fieldArray, $row);
        return $fieldArray;
    }

    /**
     * @param array $fieldArray
     * @param array $row
     * @return array
     * @throws \Exception
     */
    protected function parseArrayByHelpers(array $fieldArray, array $row)
    {
        foreach ($this->helpers as $newFieldName => $helper) {
            $className = $this->helperPrefix . $helper;
            if (!class_exists($className)) {
                throw new \Exception('Class ' . $className . ' does not exists');
            }
            if (is_subclass_of($className, $this->helperInterface)) {
                /** @var AbstractHelper $helperClass */
                $helperClass = ObjectUtility::getObjectManager()->get($className, $fieldArray, $row);
                $helperClass->initialize();
                $fieldArray[$newFieldName] = $helperClass->parseValue($fieldArray[$newFieldName]);
            } else {
                throw new \Exception('Class does not implement ' . $this->helperInterface);
            }
        }
        return $fieldArray;
    }

    /**
     * @return array
     */
    protected function getMapping()
    {
        return array_merge($this->defaultMapping, $this->mapping);
    }

    /**
     * @return void
     */
    protected function truncateTable()
    {
        if ($this->truncateBeforeImport) {
            DatabaseUtility::getConnectionForTable($this->tableName)->truncate($this->tableName);
        }
    }

    /**
     * @param $fieldName
     * @return bool
     * @throws DBALException
     */
    protected function isFieldExistingInNewTable($fieldName)
    {
        return DatabaseUtility::isFieldExistingInTable($fieldName, $this->tableName);
    }
}
