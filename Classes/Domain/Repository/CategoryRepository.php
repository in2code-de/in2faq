<?php
declare(strict_types=1);
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
    protected $defaultOrderings = array(
        'title' => QueryInterface::ORDER_ASCENDING
    );

    /**
     * @param array $settings
     * @return QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findBySettings(array $settings): QueryResultInterface
    {
        if (empty($settings['categoryFilter']['categories'])) {
            return $this->findAll();
        }

        $query = $this->createQuery();
        $constraint = $query->in(
            'uid',
            GeneralUtility::intExplode(',', $settings['categoryFilter']['categories'], true)
        );
        $query->matching($constraint);
        return $query->execute();
    }
}
