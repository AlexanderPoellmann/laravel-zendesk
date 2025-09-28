<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\UserData;
use AlexanderPoellmann\LaravelZendesk\Data\UserResponseData;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;

class CreateOrUpdateUser
{
    public function execute(UserData $data): ?object
    {
        try {
            $response = Zendesk::users()->createOrUpdate([
                'name' => $data->fullName(),
                'email' => $data->email,
                'phone' => $data->phone ?? '',
                'role' => $data->role->value,
            ]);

            return $response ? UserResponseData::from($response) : null;
        } catch (Exception $e) {
            return null;
        }
    }
}
