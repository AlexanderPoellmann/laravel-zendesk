<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\AttachmentData;
use AlexanderPoellmann\LaravelZendesk\Data\AttachmentResponse;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;

class UploadAttachment
{
    public function execute(AttachmentData $data): ?AttachmentResponse
    {
        try {
            $response = Zendesk::attachments()->upload([
                'file' => $data->filePath,
                'type' => $data->mimeType,
                'name' => $data->fileName,
            ]);

            if (! isset($response->attachment)) {
                return null;
            }

            return AttachmentResponse::from($response->attachment);
        } catch (Exception $e) {
            return null;
        }
    }
}
