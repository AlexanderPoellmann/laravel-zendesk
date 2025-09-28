<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use AlexanderPoellmann\LaravelZendesk\Enums\UserRoles;

class UserData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public UserRoles $role = UserRoles::EndUser,
        public ?string $phone = null,
    ) {
        //
    }

    public function fullName(): string
    {
        return $this->lastName.', '.$this->firstName;
    }
}
