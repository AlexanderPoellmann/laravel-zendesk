<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\TicketData;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;
use Zendesk\API\Exceptions\ApiResponseException;
use Zendesk\API\Exceptions\AuthException;
use Zendesk\API\Exceptions\ResponseException;

class CreateTicket
{
    public function execute(TicketData $data): ?object
    {
        try {
            return Zendesk::tickets()->create([
                'subject' => $data->subject,
                'comment' => [
                    'body' => $data->body,
                ],
                'priority' => $data->priority,
                'uploads' => $data->uploads,
            ]);
        } catch (ApiResponseException|AuthException|ResponseException|Exception $e) {
            return null;
        }
    }
}
