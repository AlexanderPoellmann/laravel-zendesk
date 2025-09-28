<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use AlexanderPoellmann\LaravelZendesk\Enums\Priorities;

/**
 * @see https://developer.zendesk.com/api-reference/ticketing/tickets/ticket-requests/#json-format
 */
class RequestData
{
    public function __construct(
        public int $userId,
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
