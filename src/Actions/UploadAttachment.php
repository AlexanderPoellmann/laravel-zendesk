<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\AttachmentData;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;

class UploadAttachment
{
    public function execute(AttachmentData $data): ?object
    {
        try {
            return Zendesk::attachments()->upload([
                'file' => $data->filePath,
                'type' => $data->mimeType,
                'name' => $data->fileName,
            ]);
        } catch (Exception $e) {
            return null;
        }
    }
}
