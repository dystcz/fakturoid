<?php

namespace Dystcz\LaravelFakturoid;

use Fakturoid\Client as FakturoidClient;
use Illuminate\Support\Facades\Config;

class LaravelFakturoid
{
    protected FakturoidClient $fakturoid;

    public function __construct()
    {
        $this->fakturoid = new FakturoidClient(
            Config::get('fakturoid.account_name'),
            Config::get('fakturoid.account_email'),
            Config::get('fakturoid.account_api_key'),
            Config::get('fakturoid.app_contact')
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
