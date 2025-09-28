<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use Spatie\LaravelData\Data;

class UserResponseData extends Data
{
    public function __construct(
        public int $id,
        public string $url,
        public string $name,
        public string $email,
        public string $created_at,
        public string $updated_at,
        public string $phone,
        public string $locale,
        public string $role,
    ) {
        //
    }

    public static function fromObject(object $object): self
    {
        return new self($object->user);
    }
}
