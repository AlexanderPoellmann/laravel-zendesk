<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use Spatie\LaravelData\Data;

class AttachmentResponse extends Data
{
    public function __construct(
        public int $id,
    ) {
        //
    }
}
