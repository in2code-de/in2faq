<?php
declare(strict_types=1);
namespace In2code\In2faq\Domain\Repository;

use In2code\In2faq\Utility\ObjectUtility;
use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Class QuestionRepository
 */
class QuestionRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $treeList = [];

    /**
     * @param array $settings
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findBySettings(array $settings)
    {
        $query = $this->createQuery();
        $and = [$query->greaterThan('uid', 0)];
        if ($this->getPagesFromStartpage($settings) !== []) {
            $and[] = $query->in('pid', $this->getPagesFromStartpage($settings));
        }
        if (!empty($settings['flexform']['main']['categories'])) {
            $categoryUids = GeneralUtility::trimExplode(',', $settings['flexform']['main']['categories'], true);
            $logicalOr = [];
            foreach ($categoryUids as $categoryUid) {
                $logicalOr[] = $query->equals('categories.uid', (int)$categoryUid);
            }
            $and[] = $query->logicalOr($logicalOr);
        }
        $query->matching($query->logicalAnd($and));
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /**
     * @param array $settings
     * @return int[]
     */
    protected function getPagesFromStartpage(array $settings): array
    {
        if ($this->treeList === [] && !empty($settings['flexform']['main']['startpid'])) {
            $treeList = '';
            $startPages = GeneralUtility::trimExplode(',', $settings['flexform']['main']['startpid'], true);
            $queryGenerator = ObjectUtility::getObjectManager()->get(QueryGenerator::class);
            foreach ($startPages as $startPage) {
                $treeList .= $queryGenerator->getTreeList($startPage, 20, 0, 1) . ',';
            }
            $this->treeList = GeneralUtility::trimExplode(',', $treeList, true);
        }
        return $this->treeList;
    }
}
