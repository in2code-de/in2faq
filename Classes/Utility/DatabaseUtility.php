<?php
declare(strict_types = 1);
namespace In2code\In2faq\Utility;

use Doctrine\DBAL\DBALException;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class DatabaseUtility
 * @codeCoverageIgnore
 */
class DatabaseUtility
{
    /**
     * Cache existing fields
     *
     * @var array
     */
    protected static $fieldsExisting = [];

    /**
     * @param string $tableName
     * @param bool $removeRestrictions
     * @return QueryBuilder
     */
    public static function getQueryBuilderForTable(string $tableName, bool $removeRestrictions = false): QueryBuilder
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($tableName);
        if ($removeRestrictions === true) {
            $queryBuilder->getRestrictions()->removeAll();
        }
        return $queryBuilder;
    }

    /**
     * @param string $tableName
     * @return Connection
     */
    public static function getConnectionForTable(string $tableName): Connection
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($tableName);
    }

    /**
     * @param string $fieldName
     * @param string $tableName
     * @return bool
     * @throws DBALException
     */
    public static function isFieldExistingInTable(string $fieldName, string $tableName): bool
    {
        $found = false;
        if (isset(self::$fieldsExisting[$tableName][$fieldName]) === false) {
            $connection = self::getConnectionForTable($tableName);
            $queryResult = $connection->query('describe ' . $tableName . ';')->fetchAll();
            foreach ($queryResult as $fieldProperties) {
                if ($fieldProperties['Field'] === $fieldName) {
                    $found = true;
                    break;
                }
            }
            self::$fieldsExisting[$tableName][$fieldName] = $found;
        } else {
            $found = self::$fieldsExisting[$tableName][$fieldName];
        }
        return $found;
    }
}
