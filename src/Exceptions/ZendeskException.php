<?php

namespace AlexanderPoellmann\LaravelZendesk\Exceptions;

use RuntimeException;

class ZendeskException extends RuntimeException
{
    public static function authenticationFailed(): static
    {
        return new static('Authentication failed.');
    }

    public static function badMethod(): static
    {
        return new static('The requested method does not exist.');
    }
}
