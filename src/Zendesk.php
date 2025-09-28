<?php

namespace AlexanderPoellmann\LaravelZendesk;

use AlexanderPoellmann\LaravelZendesk\Actions\CreateAnonymousRequest;
use AlexanderPoellmann\LaravelZendesk\Actions\CreateTicket;
use AlexanderPoellmann\LaravelZendesk\Actions\CreateOrUpdateUser;
use AlexanderPoellmann\LaravelZendesk\Actions\UploadAttachment;
use AlexanderPoellmann\LaravelZendesk\Data\AnonymousRequesterData;
use AlexanderPoellmann\LaravelZendesk\Data\AttachmentData;
use AlexanderPoellmann\LaravelZendesk\Data\AnonymousRequestData;
use AlexanderPoellmann\LaravelZendesk\Data\AttachmentResponse;
use AlexanderPoellmann\LaravelZendesk\Data\RequestResponse;
use AlexanderPoellmann\LaravelZendesk\Data\TicketData;
use AlexanderPoellmann\LaravelZendesk\Data\TicketResponse;
use AlexanderPoellmann\LaravelZendesk\Data\UserData;
use AlexanderPoellmann\LaravelZendesk\Data\UserResponse;
use AlexanderPoellmann\LaravelZendesk\Enums\Priorities;
use AlexanderPoellmann\LaravelZendesk\Enums\UserRoles;
use AlexanderPoellmann\LaravelZendesk\Exceptions\ZendeskException;
use Zendesk\API\Exceptions\AuthException;
use Zendesk\API\HttpClient;

class Zendesk
{
    protected string $subdomain;

    protected ?string $username;

    protected string $token;

    protected HttpClient $client;

    public function __construct()
    {
        $this->subdomain = config('services.zendesk.subdomain');
        $this->username = config('services.zendesk.username');
        $this->token = config('services.zendesk.token');

        $this->configureClient();
    }

    private function configureClient(): void
    {
        $this->client = new HttpClient($this->subdomain, $this->username);
    }

    /** @throws ZendeskException */
    public function authenticate(): self
    {
        try {
            if (! is_null($this->username)) {
                $this->client->setAuth('basic', ['username' => $this->username, 'token' => $this->token]);
            } else {
                $this->client->setAuth('oauth', ['token' => $this->token]);
            }
        } catch (AuthException $e) {
            throw ZendeskException::authenticationFailed();
        }

        return $this;
    }

    public function __call(string $method, $arguments)
    {
        if (! is_callable([$this->client, $method])) {
            throw ZendeskException::badMethod();
        }

        return $this->client->{$method}(...$arguments);
    }

    public function createOrUpdateUser(
        string $firstName,
        string $lastName,
        string $email,
        UserRoles $role = UserRoles::EndUser,
        ?string $phone = null,
    ): ?UserResponse
    {
        $userData = new UserData(
            firstName: $firstName,
            lastName: $lastName,
            email: $email,
            phone: $phone,
            role: $role,
        );

        return resolve(CreateOrUpdateUser::class)->execute(
            data: $userData,
        );
    }

    public function uploadAttachment(
        string $filePath,
        string $mimeType,
        string $fileName
    ): ?AttachmentResponse
    {
        $attachmentData = new AttachmentData(
            filePath: $filePath,
            mimeType: $mimeType,
            fileName: $fileName,
        );

        return resolve(UploadAttachment::class)->execute(
            data: $attachmentData,
        );
    }

    public function createTicket(
        string $subject,
        string $body,
        Priorities $priority = Priorities::Normal,
        array $uploads = [],
    ): ?TicketResponse
    {
        $ticketData = new TicketData(
            subject: $subject,
            body: $body,
            priority: $priority,
            uploads: $uploads,
        );

        return resolve(CreateTicket::class)->execute(
            data: $ticketData,
        );
    }

    public function createAnonymousRequest(
        string $firstName,
        string $lastName,
        string $email,
        string $recipientEmailAddress,
        string $subject,
        string $body,
        Priorities $priority = Priorities::Normal,
        array $uploads = [],
    ): ?RequestResponse
    {
        $requesterData = new AnonymousRequesterData(
            firstName: $firstName,
            lastName: $lastName,
            email: $email,
        );

        $requestData = new AnonymousRequestData(
            requester: $requesterData,
            recipientEmailAddress: $recipientEmailAddress,
            subject: $subject,
            body: $body,
            priority: $priority,
            uploads: $uploads,
        );

        return resolve(CreateAnonymousRequest::class)->execute(
            data: $requestData,
        );
    }
}
