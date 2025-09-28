<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use AlexanderPoellmann\LaravelZendesk\Enums\Priorities;

/**
 * @see https://developer.zendesk.com/api-reference/ticketing/tickets/ticket-requests/#json-format
 */
class AnonymousRequestData
{
    public function __construct(
        public AnonymousRequesterData $requester,
        public string $recipientEmailAddress,
        public string $subject,
        public string $body,
        public Priorities $priority = Priorities::Normal,
        public array $uploads = [],
    )
    {
        //
    }
}
