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
    protected $tableNameOld = 'tx_irfaq_q';

    /**
     * @var string
     */
    protected $tableName = 'tx_in2faq_domain_model_question';

    /**
     * @var array
     */
    protected $mapping = [
        'sorting' => 'sorting',
        'q' => 'question',
        'a' => 'answer',
        'q_from' => 'question_from',
        'related_links' => 'related_links',
    ];

    /**
     * @var array
     */
    protected $helpers = [
        'answer' => 'RemoveImageTagsHelper',
    ];
}
