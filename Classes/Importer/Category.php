<?php

declare(strict_types = 1);

namespace In2code\In2faq\Importer;

/**
 * Class Category
 */
class Category extends AbstractImporter
{
    /**
     * @var string
     */
    protected $tableNameOld = 'tx_irfaq_cat';

    /**
     * @var string
     */
    protected $tableName = 'tx_in2faq_domain_model_category';

    /**
     * @var array
     */
    protected $mapping = [
        'sorting' => 'sorting',
        'title' => 'title',
        'shortcut' => 'uri'
    ];
}
