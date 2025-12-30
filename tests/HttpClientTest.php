<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\HttpClient;

class HttpClientTest extends TestCase
{
    private HttpClient $client;

    protected function setUp(): void
    {
        $this->client = new HttpClient([
            'baseUrl' => 'https://auth.mizbancloud.com',
        ]);
    }

    public function testDefaultConfiguration(): void
    {
        $client = new HttpClient();
        $this->assertNull($client->getToken());
        $this->assertEquals('en', $client->getLanguage());
    }

    public function testCustomConfiguration(): void
    {
        $client = new HttpClient([
            'baseUrl' => 'https://custom.example.com',
            'timeout' => 60,
            'language' => 'fa',
        ]);

        $this->assertEquals('fa', $client->getLanguage());
    }

    public function testSetAndGetToken(): void
    {
        $this->assertNull($this->client->getToken());

        $this->client->setToken('test-token-123');

        $this->assertEquals('test-token-123', $this->client->getToken());
    }

    public function testClearToken(): void
    {
        $this->client->setToken('test-token');
        $this->assertEquals('test-token', $this->client->getToken());

        $this->client->setToken(null);
        $this->assertNull($this->client->getToken());
    }

    public function testSetAndGetLanguage(): void
    {
        $this->assertEquals('en', $this->client->getLanguage());

        $this->client->setLanguage('fa');

        $this->assertEquals('fa', $this->client->getLanguage());
    }

    public function testLanguagePersistence(): void
    {
        $this->client->setLanguage('fa');
        $this->assertEquals('fa', $this->client->getLanguage());

        $this->client->setLanguage('en');
        $this->assertEquals('en', $this->client->getLanguage());
    }
}
