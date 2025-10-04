<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use Spatie\LaravelData\Data;

class UploadResponse extends Data
{
    public function __construct(
        public string $token,
        public string $expires_at,
        public array $attachments,
    ) {
        //
    }
}
