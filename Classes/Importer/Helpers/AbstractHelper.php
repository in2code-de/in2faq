<?php

declare(strict_types=1);

namespace In2code\In2faq\Importer\Helpers;

/**
 * Class AbstractHelper
 */
abstract class AbstractHelper implements HelperInterface
{

    /**
     * @param array
     */
    protected array $newProperties = [];

    /**
     * @param array
     */
    protected array $oldProperties = [];

    /**
     * AbstractHelper constructor.
     * @param array $newProperties
     * @param array $oldProperties
     */
    public function __construct(array $newProperties, array $oldProperties)
    {
        $this->newProperties = $newProperties;
        $this->oldProperties = $oldProperties;
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
