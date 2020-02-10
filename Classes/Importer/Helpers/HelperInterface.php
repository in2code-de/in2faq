<?php
declare(strict_types=1);
namespace In2code\In2faq\Importer\Helpers;

/**
 * Interface HelperInterface
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
