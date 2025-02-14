<?php

namespace Dystcz\LaravelFakturoid\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Fakturoid extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-fakturoid';
    }
}
