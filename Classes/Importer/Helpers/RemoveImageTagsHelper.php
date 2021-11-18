<?php

declare(strict_types = 1);

namespace In2code\In2faq\Importer\Helpers;

/**
 * Class RemoveImageTagsHelper
 */
class RemoveImageTagsHelper extends AbstractHelper
{
    /**
     * Allowed tags for RTE
     *
     * @var array
     */
    protected array $allowedTags = [
        '<div>',
        '<br>',
        '<p>',
        '<ol>',
        '<ul>',
        '<li>',
        '<h1>',
        '<h2>',
        '<h3>',
        '<h4>',
        '<h5>',
        '<h6>',
        '<hr>',
        '<a>',
        '<link>',
        '<em>',
        '<i>',
        '<b>',
        '<strong>',
        '<span>',
        '<blockquote>',
        '<iframe>',
    ];

    /**
     * Try to remove not allowed tags (img e.g.) from a string
     *
     * @param string $value
     * @return string
     */
    public function parseValue($value): string
    {
        return strip_tags($value, implode('', $this->allowedTags));
    }
}
