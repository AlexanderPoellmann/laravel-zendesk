<?php

namespace AlexanderPoellmann\LaravelZendesk;

use AlexanderPoellmann\LaravelZendesk\Actions\CreateRequest;
use AlexanderPoellmann\LaravelZendesk\Actions\CreateTicket;
use AlexanderPoellmann\LaravelZendesk\Actions\CreateOrUpdateUser;
use AlexanderPoellmann\LaravelZendesk\Actions\UploadAttachment;
use AlexanderPoellmann\LaravelZendesk\Data\AttachmentData;
use AlexanderPoellmann\LaravelZendesk\Data\RequestData;
use AlexanderPoellmann\LaravelZendesk\Data\TicketData;
use AlexanderPoellmann\LaravelZendesk\Data\UserData;
use AlexanderPoellmann\LaravelZendesk\Data\UserResponseData;
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

    /** @throws ZendeskException */
    private function configureClient(): void
    {
        $this->client = new HttpClient($this->subdomain, $this->username);

        try {
            if (! is_null($this->username)) {
                $this->client->setAuth('basic', ['username' => $this->username, 'token' => $this->token]);
            } else {
                $this->client->setAuth('oauth', ['token' => $this->token]);
            }
        } catch (AuthException $e) {
            throw ZendeskException::authenticationFailed();
        }
    }

    public function __call(string $method, $arguments)
    {
        if (! is_callable([$this->client, $method])) {
            throw ZendeskException::badMethod();
        }

        return $this->client->{$method}(...$arguments);
    }

    public function createOrUpdateUser(string $firstName, string $lastName, string $email, UserRoles $role = UserRoles::EndUser, ?string $phone = null): ?UserResponseData
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

    public function uploadAttachment(string $filePath, string $mimeType, string $fileName): ?object
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

    public function createTicket(string $subject, string $body, Priorities $priority = Priorities::Normal, array $uploads = []): ?object
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

    public function createRequest(int $userId, string $recipientEmailAddress, string $subject, string $body, Priorities $priority = Priorities::Normal, array $uploads = []): ?object
    {
        $requestData = new RequestData(
            userId: $userId,
            recipientEmailAddress: $recipientEmailAddress,
            subject: $subject,
            body: $body,
            priority: $priority,
            uploads: $uploads,
        );

        return resolve(CreateRequest::class)->execute(
            data: $requestData,
        );
    }
}
