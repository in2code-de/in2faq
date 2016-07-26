<?php
namespace In2code\In2faq\Importer\Helpers;

/**
 * Interface HelperInterface
 * @package In2code\In2faq\Importer
 */
interface HelperInterface
{

    /**
     * @return void
     */
    public function initialize();

    /**
     * Parse the value
     * 
     * @param string $value
     * @return string
     */
    public function parseValue($value);
}
