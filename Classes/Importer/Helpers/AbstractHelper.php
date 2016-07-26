<?php
namespace In2code\In2faq\Importer\Helpers;

/**
 * Class AbstractHelper
 * @package In2code\In2faq\Importer\Helpers
 */
abstract class AbstractHelper implements HelperInterface
{

    /**
     * @param array
     */
    protected $newProperties = [];

    /**
     * @param array
     */
    protected $oldProperties = [];

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

    /**
     * @return mixed
     */
    public function getOldKey()
    {
        return $this->oldKey;
    }

    /**
     * @return mixed
     */
    public function getNewKey()
    {
        return $this->newKey;
    }
}
