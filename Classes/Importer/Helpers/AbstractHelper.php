<?php

declare(strict_types=1);

namespace In2code\In2faq\Importer\Helpers;

/**
 * Class AbstractHelper
 */
abstract class AbstractHelper implements HelperInterface
{
    /**
     * AbstractHelper constructor.
     */
    public function __construct(
        /**
         * @param array
         */
        protected array $newProperties,
        /**
         * @param array
         */
        protected array $oldProperties
    )
    {
    }

    /**
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * @return mixed
     */
    public function getNewProperties()
    {
        return $this->newProperties;
    }

    /**
     * @return mixed
     */
    public function getOldProperties()
    {
        return $this->oldProperties;
    }
}
