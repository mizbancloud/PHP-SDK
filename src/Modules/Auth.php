<?php

declare(strict_types=1);

namespace MizbanCloud\Modules;

use MizbanCloud\HttpClient;

/**
 * Authentication Module
 *
 * Handles API token authentication and wallet info.
 */
class Auth
{
    public function __construct(
        private readonly HttpClient $client
    ) {}

    /**
     * Set API token for authentication
     * All subsequent requests will include this token
     */
    public function setApiToken(string $token): void
    {
        $this->client->setToken($token);
    }

    /**
     * Get current API token
     */
    public function getApiToken(): ?string
    {
        return $this->client->getToken();
    }

    /**
     * Clear API token
     */
    public function clearApiToken(): void
    {
        $this->client->setToken(null);
    }

    /**
     * Get wallet balance and info
     *
     * @return array{success: bool, message: string, data: array{balance: float, currency: string}}
     */
    public function getWallet(): array
    {
        return $this->client->get('/api/admin-temp-v1/financial/wallet');
    }
}
