<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

/**
 * @see https://developer.zendesk.com/documentation/ticketing/managing-tickets/creating-and-managing-requests/#creating-anonymous-requests
 */
class AnonymousRequesterData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public ?string $locale = null,
    )
    {
        //
    }

    public function fullName(): string
    {
        return $this->lastName . ', ' . $this->firstName;
    }
}
