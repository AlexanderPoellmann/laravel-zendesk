<?php

namespace AlexanderPoellmann\LaravelZendesk\Actions;

use AlexanderPoellmann\LaravelZendesk\Data\AttachmentData;
use AlexanderPoellmann\LaravelZendesk\Data\UploadResponse;
use AlexanderPoellmann\LaravelZendesk\Facades\Zendesk;
use Exception;

class UploadAttachment
{
    public function execute(AttachmentData $data): ?UploadResponse
    {
        try {
            $response = Zendesk::attachments()->upload([
                'file' => $data->filePath,
                'type' => $data->mimeType,
                'name' => $data->fileName,
            ]);

            if (! isset($response->upload)) {
                return null;
            }

            return UploadResponse::from($response->upload);
        } catch (Exception $e) {
            return null;
        }
    }
}
