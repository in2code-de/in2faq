<?php

declare(strict_types=1);

namespace In2code\In2faq\Importer;

/**
 * Class QuestionCategory
 */
class QuestionCategory extends AbstractImporter
{
    /**
     * @var string
     */
    protected string $tableNameOld = 'tx_irfaq_q_cat_mm';

    /**
     * @var string
     */
    protected string $tableName = 'tx_in2faq_question_category_mm';

    /**
     * @var array
     */
    protected array $mapping = [
        'uid_local' => 'uid_local',
        'uid_foreign' => 'uid_foreign',
        'tablenames' => 'tablenames',
        'sorting' => 'sorting'
    ];
}
