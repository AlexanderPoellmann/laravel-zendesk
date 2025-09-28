<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use AlexanderPoellmann\LaravelZendesk\Enums\UserRoles;
use Spatie\LaravelData\Data;

class UserResponse extends Data
{
    public function __construct(
        public int $id,
        public string $url,
        public string $name,
        public string $email,
        public string $created_at,
        public string $updated_at,
        public string $time_zone,
        public string $iana_time_zone,
        public string $locale,
        public string $role = UserRoles::EndUser->value,
        public ?string $phone = null,
        public ?string $organization_id = null,
        public ?string $details = null,
        public ?string $notes = null,
        public ?string $ticket_restriction = null,
        public bool $verified = false,
        public bool $active = false,
        public bool $suspended = false,
        public bool $restricted_agent = true,
    ) {
        //
    }
}
