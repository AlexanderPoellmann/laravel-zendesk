<?php

namespace AlexanderPoellmann\LaravelZendesk\Facades;

use AlexanderPoellmann\LaravelZendesk\Data\RequestResponse;
use AlexanderPoellmann\LaravelZendesk\Data\TicketResponse;
use AlexanderPoellmann\LaravelZendesk\Data\UploadResponse;
use AlexanderPoellmann\LaravelZendesk\Data\UserResponse;
use AlexanderPoellmann\LaravelZendesk\Enums\Priorities;
use AlexanderPoellmann\LaravelZendesk\Enums\UserRoles;
use Illuminate\Support\Facades\Facade;

/**
 * @see \AlexanderPoellmann\LaravelZendesk\Zendesk
 *
 * @mixin \Zendesk\API\HttpClient
 *
 * @method void configureClient()
 * @method self authenticate()
 * @method static null|UserResponse createOrUpdateUser(string $firstName, string $lastName, string $email, UserRoles $role = UserRoles::EndUser, null|string $phone = null)
 * @method static null|UploadResponse uploadAttachment(string $filePath, string $mimeType, string $fileName)
 * @method static null|TicketResponse createTicket(string $subject, string $body, Priorities $priority = Priorities::Normal, array $uploads = [])
 * @method static null|RequestResponse createAnonymousRequest(string $firstName, string $lastName, string $email, string $recipientEmailAddress, string $subject, string $body, Priorities $priority = Priorities::Normal, array $uploads = [])
 */
class Zendesk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlexanderPoellmann\LaravelZendesk\Zendesk::class;
    }
}
