<?php
declare(strict_types = 1);
namespace In2code\In2faq\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Class CategoryRepository
 */
class CategoryRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'title' => QueryInterface::ORDER_ASCENDING
    ];

    /**
     * @param array $settings
     * @param array $data tt_content.*
     * @return QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findBySettings(array $settings, array $data): QueryResultInterface
    {
        $query = $this->createQuery();
        $logicalAnd = [];
        if (!empty($settings['categoryFilter']['categories'])) {
            $logicalAnd[] = $query->in(
                'uid',
                GeneralUtility::intExplode(',', $settings['categoryFilter']['categories'], true)
            );
        } elseif ($data['pages'] !== '') {
            $logicalAnd[] = $query->in('pid', GeneralUtility::intExplode(',', $data['pages'], true));
        }
        if ($logicalAnd !== []) {
            $query->matching($query->logicalAnd($logicalAnd));
        }
        return $query->execute();
    }
}
