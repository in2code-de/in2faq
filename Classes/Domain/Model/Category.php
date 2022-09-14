<?php

declare(strict_types=1);
namespace In2code\In2faq\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Category
 */
class Category extends AbstractEntity
{
    const TABLE_NAME = 'tx_in2faq_domain_model_category';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $uri = '';

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Category
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }
}
