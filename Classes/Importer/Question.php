<?php

declare(strict_types=1);

namespace In2code\In2faq\Importer;

/**
 * Class Question
 */
class Question extends AbstractImporter
{
    /**
     * @var string
     */
    protected string $tableNameOld = 'tx_irfaq_q';

    /**
     * @var string
     */
    protected string $tableName = 'tx_in2faq_domain_model_question';

    /**
     * @var array
     */
    protected array $mapping = [
        'sorting' => 'sorting',
        'q' => 'question',
        'a' => 'answer',
        'q_from' => 'question_from',
        'related_links' => 'related_links',
        'expert' => 'expert'
    ];

    /**
     * @var array
     */
    protected array $helpers = [
        'answer' => 'RemoveImageTagsHelper'
    ];
}
