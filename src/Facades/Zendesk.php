<?php

namespace AlexanderPoellmann\LaravelZendesk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlexanderPoellmann\LaravelZendesk\Zendesk
 *
 * @mixin \Zendesk\API\HttpClient
 */
class Zendesk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlexanderPoellmann\LaravelZendesk\Zendesk::class;
    }
}
