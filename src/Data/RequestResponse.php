<?php

namespace AlexanderPoellmann\LaravelZendesk\Data;

use Spatie\LaravelData\Data;

class RequestResponse extends Data
{
    public function __construct(
        public int $id,
        public string $url,
        public string $status,
        public string $type,
        public string $subject,
        public string $description,
        public int $requester_id,
        public array $collaborator_ids,
        public array $email_cc_ids,
        public string $created_at,
        public string $updated_at,
        public ?string $due_at = null,
        public ?string $priority = null,
        public ?string $organization_id = null,
        public ?string $recipient = null,
        public ?int $assignee_id = null,
        public ?int $custom_status_id = null,
        public bool $is_public = false,
    )
    {
        //
    }
}
