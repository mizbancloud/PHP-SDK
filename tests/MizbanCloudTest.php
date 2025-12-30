<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\MizbanCloud;

class MizbanCloudTest extends TestCase
{
    private MizbanCloud $client;

    protected function setUp(): void
    {
        $this->client = new MizbanCloud([
            'baseUrl' => 'https://auth.mizbancloud.com',
        ]);
    }

    public function testClientInitialization(): void
    {
        $this->assertInstanceOf(MizbanCloud::class, $this->client);
    }

    public function testModulesExist(): void
    {
        $this->assertNotNull($this->client->auth);
        $this->assertNotNull($this->client->cdn);
        $this->assertNotNull($this->client->cloud);
        $this->assertNotNull($this->client->statics);
    }

    public function testSetAndGetToken(): void
    {
        $this->assertNull($this->client->getToken());
        $this->assertFalse($this->client->isAuthenticated());

        $this->client->setToken('test-token');

        $this->assertEquals('test-token', $this->client->getToken());
        $this->assertTrue($this->client->isAuthenticated());
    }

    public function testSetAndGetLanguage(): void
    {
        $this->assertEquals('en', $this->client->getLanguage());

        $this->client->setLanguage('fa');

        $this->assertEquals('fa', $this->client->getLanguage());
    }

    public function testCustomConfig(): void
    {
        $client = new MizbanCloud([
            'baseUrl' => 'https://custom.example.com',
            'timeout' => 60,
            'language' => 'fa',
        ]);

        $this->assertEquals('fa', $client->getLanguage());
    }
}
