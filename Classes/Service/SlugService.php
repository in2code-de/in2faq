<?php

namespace In2code\In2faq\Service;

use Doctrine\DBAL\Driver\Statement;
use PDO;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SlugService
 */
class SlugService
{
    /**
     * @var SlugHelper
     */
    protected $slugService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $fieldConfig = $GLOBALS['TCA']['tx_in2faq_domain_model_question']['columns']['path_segment']['config'];
        $this->slugService = GeneralUtility::makeInstance(SlugHelper::class, 'tx_in2faq_domain_model_question', 'path_segment', $fieldConfig);
    }

    /**
     * @return int
     */
    public function countOfSlugUpdates(): int
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_in2faq_domain_model_question');
        $queryBuilder->getRestrictions()->removeAll();
        $elementCount = $queryBuilder->count('uid')
            ->from('tx_in2faq_domain_model_question')
            ->where(
                $queryBuilder->expr()->or(
                    $queryBuilder->expr()->eq('path_segment', $queryBuilder->createNamedParameter('', PDO::PARAM_STR)),
                    $queryBuilder->expr()->isNull('path_segment')
                )
            )
            ->execute()->fetchColumn(0);

        return $elementCount;
    }

    /**
     * @return array
     */
    public function performUpdates(): array
    {
        $databaseQueries = [];

        /** @var Connection $connection */
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_in2faq_domain_model_question');
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll();
        $statement = $queryBuilder->select('*')
            ->from('tx_in2faq_domain_model_question')
            ->where(
                $queryBuilder->expr()->or(
                    $queryBuilder->expr()->eq('path_segment', $queryBuilder->createNamedParameter('', PDO::PARAM_STR)),
                    $queryBuilder->expr()->isNull('path_segment')
                )
            )
            ->execute();
        while ($record = $statement->fetch()) {
            if ((string)$record['question'] !== '') {
                $slug = $this->slugService->generate($record, $record['pid']);
                $queryBuilder = $connection->createQueryBuilder();
                $queryBuilder->update('tx_in2faq_domain_model_question')
                    ->where(
                        $queryBuilder->expr()->eq(
                            'uid',
                            $queryBuilder->createNamedParameter($record['uid'], PDO::PARAM_INT)
                        )
                    )
                    ->set('path_segment', $this->getUniqueValue($record['uid'], $slug));
                $databaseQueries[] = $queryBuilder->getSQL();
                $queryBuilder->execute();
            }
        }

        return $databaseQueries;
    }

    /**
     * @param int $uid
     * @param string $slug
     * @return string
     */
    protected function getUniqueValue(int $uid, string $slug): string
    {
        $statement = $this->getUniqueCountStatement($uid, $slug);
        if ($statement->fetchColumn()) {
            for ($counter = 1; $counter <= 100; $counter++) {
                $newSlug = $slug . '-' . $counter;
                $statement->bindValue(1, $newSlug);
                $statement->execute();
                if (!$statement->fetchColumn()) {
                    break;
                }
            }
        }

        return $newSlug ?? $slug;
    }

    /**
     * @param int $uid
     * @param string $slug
     * @return Statement|int
     */
    protected function getUniqueCountStatement(int $uid, string $slug)
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_in2faq_domain_model_question');
        /** @var DeletedRestriction $deleteRestriction */
        $deleteRestriction = GeneralUtility::makeInstance(DeletedRestriction::class);
        $queryBuilder->getRestrictions()->removeAll()->add($deleteRestriction);

        return $queryBuilder
            ->count('uid')
            ->from('tx_in2faq_domain_model_question')
            ->where(
                $queryBuilder->expr()->eq(
                    'path_segment',
                    $queryBuilder->createPositionalParameter($slug)
                ),
                $queryBuilder->expr()->neq('uid', $queryBuilder->createPositionalParameter($uid, PDO::PARAM_INT))
            )->execute();
    }
}
