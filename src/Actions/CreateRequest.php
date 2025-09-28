<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\RequestData;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;

class CreateRequest
{
    public function execute(RequestData $data): ?object
    {
        try {
            return Zendesk::requests()->create([
                'requester_id' => $data->userId,
                'subject' => $data->subject,
                'comment' => [
                    'body' => $data->body,
                    'uploads' => $data->uploads,
                ],
                'priority' => $data->priority,
            ]);
        } catch (Exception $e) {
            return null;
        }
    }
}
