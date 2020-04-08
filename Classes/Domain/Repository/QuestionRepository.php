<?php
declare(strict_types=1);
namespace In2code\In2faq\Domain\Repository;

use In2code\In2faq\Domain\Model\Dto\Filter;
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
     * @param Filter $filter
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByFilterAndSettings(Filter $filter)
    {
        $query = $this->createQuery();
        $and = [];
        $and = $this->filterBySettingsStartpages($query, $and, $filter->getSettings());
        $and = $this->filterBySettingsCategories($query, $and, $filter->getSettings());
        $and = $this->filterByFilterSearchterm($query, $and, $filter);
        $and = $this->filterByFilterCategory($query, $and, $filter);
        if ($and !== []) {
            $query->matching($query->logicalAnd($and));
        }
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /**
     * @param QueryInterface $query
     * @param array $and
     * @param array $settings
     * @return array
     * @throws InvalidQueryException
     */
    protected function filterBySettingsStartpages(QueryInterface $query, array $and, array $settings): array
    {
        if ($this->getPagesFromStartpage($settings) !== []) {
            $and[] = $query->in('pid', $this->getPagesFromStartpage($settings));
        }
        return $and;
    }

    /**
     * @param QueryInterface $query
     * @param array $and
     * @param array $settings
     * @return array
     */
    protected function filterBySettingsCategories(QueryInterface $query, array $and, array $settings): array
    {
        if (!empty($settings['flexform']['main']['categories'])) {
            $categoryUids = GeneralUtility::trimExplode(',', $settings['flexform']['main']['categories'], true);
            $logicalOr = [];
            foreach ($categoryUids as $categoryUid) {
                $logicalOr[] = $query->equals('categories.uid', (int)$categoryUid);
            }
            $and[] = $query->logicalOr($logicalOr);
        }
        return $and;
    }

    /**
     * @param QueryInterface $query
     * @param array $and
     * @param Filter $filter
     * @return array
     * @throws InvalidQueryException
     */
    protected function filterByFilterSearchterm(QueryInterface $query, array $and, Filter $filter): array
    {
        if ($filter->getSearchterm() !== '') {
            $logicalOr = [];
            foreach ($filter->getSearchterms() as $searchterm) {
                $logicalOr[] = $query->like('question', '%' . $searchterm . '%');
                $logicalOr[] = $query->like('answer', '%' . $searchterm . '%');
            }
            $and[] = $query->logicalOr($logicalOr);
        }
        return $and;
    }

    /**
     * @param QueryInterface $query
     * @param array $and
     * @param Filter $filter
     * @return array
     * @throws InvalidQueryException
     */
    protected function filterByFilterCategory(QueryInterface $query, array $and, Filter $filter): array
    {
        if ($filter->getCategory() !== null) {
            $and[] = $query->contains('categories', $filter->getCategory());
        }
        return $and;
    }

    /**
     * @param array $settings
     * @return int[]
     */
    protected function getPagesFromStartpage(array $settings): array
    {
        if (!empty($settings['flexform']['main']['startpid'])) {
            $treeList = '';
            $startPages = GeneralUtility::trimExplode(',', $settings['flexform']['main']['startpid'], true);
            $queryGenerator = ObjectUtility::getObjectManager()->get(QueryGenerator::class);
            foreach ($startPages as $startPage) {
                $treeList .= $queryGenerator->getTreeList($startPage, 20, 0, 1) . ',';
            }
            return GeneralUtility::trimExplode(',', $treeList, true);
        }
        return [];
    }
}
