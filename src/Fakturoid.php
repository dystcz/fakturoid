<?php

namespace Dystcz\Fakturoid;

use BadMethodCallException;
use Fakturoid\Exception\AuthorizationFailedException;
use Fakturoid\FakturoidManager;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\Config;

/**
 * @see \Fakturoid\FakturoidManager
 */
class Fakturoid
{
    protected FakturoidManager $fakturoid;

    /**
     * @throws AuthorizationFailedException
     */
    public function __construct()
    {
        $this->fakturoid = new FakturoidManager(
            client: new Guzzle,
            clientId: Config::get('fakturoid.account_api_id'),
            clientSecret: Config::get('fakturoid.account_api_secret'),
            userAgent: Config::get('fakturoid.user_agent'),
            accountSlug: Config::get('fakturoid.account_slug'),
        );

        $this->fakturoid->authClientCredentials();
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}(...$arguments);
        }

        if (method_exists($this->fakturoid, $method)) {
            return $this->fakturoid->{$method}(...$arguments);
        }

        throw new BadMethodCallException("Method '{$method}' does not exist on Fakturoid manager.");
    }
}
