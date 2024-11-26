<?php

declare(strict_types=1);
namespace In2code\In2faq\Utility;

use Psr\Http\Message\RequestInterface;

/**
 * Class FrontendUtility
 */
class FrontendUtility
{
    /**
     * Because GET params can be rewritten via routing configuration and so only available via TSFE on the one hand
     * and on the other hand some POST params are still available when a form is submitted, we need a function that
     * merges both sources
     */
    public static function getArguments(RequestInterface $request, $key = 'tx_in2faq_pi1'): array
    {
        return self::getArgumentsFromGetOrPostRequest($key, $request);
    }

    /**
     * @return array
     */
    protected static function getArgumentsFromGetOrPostRequest(string $key, RequestInterface $request): ?array
    {
        $value = $request->getParsedBody()[$key] ?? $request->getQueryParams()[$key] ?? null;
        return (array)$value;
    }
}
