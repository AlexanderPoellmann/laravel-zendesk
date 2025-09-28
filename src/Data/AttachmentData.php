<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

class AttachmentData
{
    public function __construct(
        public string $filePath,
        public string $mimeType,
        public string $fileName,
    ) {
        //
    }
}
