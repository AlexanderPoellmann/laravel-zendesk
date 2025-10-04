<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use AlexanderPoellmann\LaravelZendesk\Enums\UserRoles;

class UserData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public ?string $phone = null,
        public UserRoles $role = UserRoles::EndUser,
    ) {
        //
    }

    public function fullName(): string
    {
        return $this->lastName.', '.$this->firstName;
    }
}
