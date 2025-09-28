<?php

namespace AlexanderPoellmann\LaravelZendesk;

use AlexanderPoellmann\LaravelZendesk\Exceptions\ZendeskException;
use Zendesk\API\Exceptions\AuthException;
use Zendesk\API\HttpClient;

class LaravelZendesk
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
}
