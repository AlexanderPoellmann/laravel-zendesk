<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\UserData;
use AlexanderPoellmann\LaravelZendesk\Data\UserResponse;
use Exception;

class CreateOrUpdateUser
{
    public function execute(UserData $data): ?UserResponse
    {
        try {
            $response = zendesk()->authenticate()->users()->createOrUpdate([
                'name' => $data->fullName(),
                'email' => $data->email,
                'phone' => $data->phone ?? '',
                'role' => $data->role->value,
            ]);

            if (! isset($response->user)) {
                return null;
            }

            return UserResponse::from($response->user);
        } catch (Exception $e) {
            return null;
        }
    }
}
