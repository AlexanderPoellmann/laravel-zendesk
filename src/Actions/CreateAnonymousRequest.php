<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\AnonymousRequestData;
use AlexanderPoellmann\LaravelZendesk\Data\RequestResponse;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;

class CreateAnonymousRequest
{
    public function execute(AnonymousRequestData $data): ?RequestResponse
    {
        try {
            $response = resolve(Zendesk::class)->requests()->create([
                'requester' => [
                    'name' => $data->requester->fullName(),
                    'email' => $data->requester->email,
                ],
                'recipient' => $data->recipientEmailAddress,
                'subject' => $data->subject,
                'comment' => [
                    'body' => $data->body,
                    'uploads' => $data->uploads,
                ],
                'priority' => $data->priority,
            ]);

            if (! isset($response->request)) {
                return null;
            }

            return RequestResponse::from($response->request);
        } catch (Exception $e) {
            return null;
        }
    }
}
