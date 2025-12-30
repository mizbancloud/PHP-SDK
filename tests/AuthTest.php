<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\MizbanCloud;

class AuthTest extends TestCase
{
    private MizbanCloud $client;

    protected function setUp(): void
    {
        $this->client = new MizbanCloud([
            'baseUrl' => 'https://auth.mizbancloud.com',
        ]);
    }

    public function testAuthModuleExists(): void
    {
        $this->assertNotNull($this->client->auth);
    }

    public function testSetApiToken(): void
    {
        $this->assertNull($this->client->auth->getApiToken());

        $this->client->auth->setApiToken('my-api-token');

        $this->assertEquals('my-api-token', $this->client->auth->getApiToken());
    }

    public function testGetApiToken(): void
    {
        $this->assertNull($this->client->auth->getApiToken());

        $this->client->setToken('test-token');

        $this->assertEquals('test-token', $this->client->auth->getApiToken());
    }

    public function testClearApiToken(): void
    {
        $this->client->auth->setApiToken('token-to-clear');
        $this->assertEquals('token-to-clear', $this->client->auth->getApiToken());

        $this->client->auth->clearApiToken();

        $this->assertNull($this->client->auth->getApiToken());
    }

    public function testTokenSyncWithMainClient(): void
    {
        // Set via auth module
        $this->client->auth->setApiToken('auth-token');
        $this->assertEquals('auth-token', $this->client->getToken());

        // Set via main client
        $this->client->setToken('main-token');
        $this->assertEquals('main-token', $this->client->auth->getApiToken());
    }

    public function testIsAuthenticatedAfterSettingToken(): void
    {
        $this->assertFalse($this->client->isAuthenticated());

        $this->client->auth->setApiToken('test-token');

        $this->assertTrue($this->client->isAuthenticated());
    }

    public function testIsNotAuthenticatedAfterClearingToken(): void
    {
        $this->client->auth->setApiToken('test-token');
        $this->assertTrue($this->client->isAuthenticated());

        $this->client->auth->clearApiToken();

        $this->assertFalse($this->client->isAuthenticated());
    }
}
