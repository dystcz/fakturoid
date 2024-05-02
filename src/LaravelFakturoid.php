<?php

namespace Dystcz\LaravelFakturoid;

use Fakturoid\Client as FakturoidClient;

class LaravelFakturoid
{
    protected FakturoidClient $fakturoid;

    public function __construct()
    {
        $this->fakturoid = new FakturoidClient(
            config('fakturoid.account_name'),
            config('fakturoid.account_email'),
            config('fakturoid.account_api_key'),
            config('fakturoid.app_contact')
        );
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}(...$arguments);
        }

        if (method_exists($this->fakturoid, $method)) {
            return $this->fakturoid->{$method}(...$arguments);
        }

        throw new \BadMethodCallException("Method '{$method}' does not exist on Fakturoid instance.");
    }
}
