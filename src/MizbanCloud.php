<?php

declare(strict_types=1);

namespace MizbanCloud;

use MizbanCloud\Modules\Auth;
use MizbanCloud\Modules\Cdn;
use MizbanCloud\Modules\Cloud;
use MizbanCloud\Modules\Statics;

/**
 * MizbanCloud SDK
 *
 * Official SDK for interacting with MizbanCloud CDN and Cloud APIs.
 *
 * @example
 * ```php
 * use MizbanCloud\MizbanCloud;
 *
 * $client = new MizbanCloud([
 *     'baseUrl' => 'https://auth.mizbancloud.com',
 * ]);
 *
 * // Set API token
 * $client->setToken('your-api-token');
 *
 * // List domains
 * $domains = $client->cdn->listDomains();
 *
 * // List servers
 * $servers = $client->cloud->listServers();
 * ```
 */
class MizbanCloud
{
    private HttpClient $httpClient;

    /**
     * Authentication module - API token management, wallet
     */
    public readonly Auth $auth;

    /**
     * CDN module - domains, DNS, SSL, cache, security
     */
    public readonly Cdn $cdn;

    /**
     * Cloud module - servers, firewall, networks, volumes
     */
    public readonly Cloud $cloud;

    /**
     * Statics module - datacenters, OS list, catalog data
     */
    public readonly Statics $statics;

    /**
     * Create a new MizbanCloud SDK instance
     *
     * @param array $config Configuration options:
     *   - baseUrl: API base URL (default: https://auth.mizbancloud.com)
     *   - timeout: Request timeout in seconds (default: 30)
     *   - language: Response language 'en' or 'fa' (default: 'en')
     *   - headers: Additional headers to include in all requests
     */
    public function __construct(array $config = [])
    {
        $this->httpClient = new HttpClient($config);

        $this->auth = new Auth($this->httpClient);
        $this->cdn = new Cdn($this->httpClient);
        $this->cloud = new Cloud($this->httpClient);
        $this->statics = new Statics($this->httpClient);
    }

    /**
     * Set API token for authentication
     * All subsequent requests will include this token
     */
    public function setToken(string $token): void
    {
        $this->httpClient->setToken($token);
    }

    /**
     * Get current API token
     */
    public function getToken(): ?string
    {
        return $this->httpClient->getToken();
    }

    /**
     * Set language for API responses
     */
    public function setLanguage(string $language): void
    {
        $this->httpClient->setLanguage($language);
    }

    /**
     * Get current language setting
     */
    public function getLanguage(): string
    {
        return $this->httpClient->getLanguage();
    }

    /**
     * Check if API token is set
     */
    public function isAuthenticated(): bool
    {
        return $this->httpClient->getToken() !== null;
    }
}
