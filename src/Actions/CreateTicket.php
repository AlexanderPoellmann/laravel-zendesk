<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\TicketData;
use AlexanderPoellmann\LaravelZendesk\Data\TicketResponse;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;
use Zendesk\API\Exceptions\ApiResponseException;
use Zendesk\API\Exceptions\AuthException;
use Zendesk\API\Exceptions\ResponseException;

class CreateTicket
{
    public function execute(TicketData $data): ?TicketResponse
    {
        try {
            $response = resolve(Zendesk::class)->authenticate()->tickets()->create([
                'subject' => $data->subject,
                'comment' => [
                    'body' => $data->body,
                ],
                'priority' => $data->priority,
                'uploads' => $data->uploads,
            ]);

            if (! isset($response->ticket)) {
                return null;
            }

            return TicketResponse::from($response->ticket);
        } catch (ApiResponseException|AuthException|ResponseException|Exception $e) {
            return null;
        }
    }
}
