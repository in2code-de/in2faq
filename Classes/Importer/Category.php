<?php

declare(strict_types=1);

namespace In2code\In2faq\Importer;

/**
 * Class Category
 */
class Category extends AbstractImporter
{
    /**
     * @var string
     */
    protected string $tableNameOld = 'tx_irfaq_cat';

    /**
     * @var string
     */
    protected string $tableName = 'tx_in2faq_domain_model_category';

    /**
     * @var array
     */
    protected array $mapping = [
        'sorting' => 'sorting',
        'title' => 'title',
        'shortcut' => 'uri'
    ];
}
