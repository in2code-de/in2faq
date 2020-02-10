<?php
declare(strict_types=1);
namespace In2code\In2faq\Importer;

/**
 * Class Expert
 */
class Expert extends AbstractImporter
{
    /**
     * @var string
     */
    protected $tableNameOld = 'tx_irfaq_expert';

    /**
     * @var string
     */
    protected $tableName = 'tx_in2faq_domain_model_expert';

    /**
     * @var array
     */
    protected $mapping = [
        'name' => 'name',
        'email' => 'email',
        'url' => 'uri'
    ];
}
