<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use Spatie\LaravelData\Data;

class AttachmentResponse extends Data
{
    public function __construct(
        public int $id,
        public string $file_name,
        public string $content_type,
        public string $url,
        public string $content_url,
    ) {
        //
    }
}
