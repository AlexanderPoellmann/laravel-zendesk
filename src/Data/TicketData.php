<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use AlexanderPoellmann\LaravelZendesk\Enums\Priorities;

/**
 * @see https://developer.zendesk.com/api-reference/ticketing/tickets/tickets/#json-format
 */
class TicketData
{
    public function __construct(
        public string $subject,
        public string $body,
        public Priorities $priority = Priorities::Normal,
        public array $uploads = [],
    )
    {
        //
    }
}
