<?php

namespace AlexanderPoellmann\LaravelZendesk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlexanderPoellmann\LaravelZendesk\LaravelZendesk
 */
class LaravelZendesk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlexanderPoellmann\LaravelZendesk\LaravelZendesk::class;
    }
}
