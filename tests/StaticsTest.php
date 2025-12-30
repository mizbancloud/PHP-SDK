<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\MizbanCloud;
use MizbanCloud\Modules\Statics;

class StaticsTest extends TestCase
{
    private MizbanCloud $client;

    protected function setUp(): void
    {
        $this->client = new MizbanCloud([
            'baseUrl' => 'https://auth.mizbancloud.com',
        ]);
    }

    public function testStaticsModuleExists(): void
    {
        $this->assertNotNull($this->client->statics);
        $this->assertInstanceOf(Statics::class, $this->client->statics);
    }

    public function testListDatacentersMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->statics, 'listDatacenters'));
    }

    public function testListOperatingSystemsMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->statics, 'listOperatingSystems'));
    }

    public function testGetCacheTimesMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->statics, 'getCacheTimes'));
    }

    public function testGetSlidersMethodExists(): void
    {
        $this->assertTrue(method_exists($this->client->statics, 'getSliders'));
    }

    public function testStaticsModuleMethodCount(): void
    {
        $reflection = new \ReflectionClass($this->client->statics);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        // Filter out constructor
        $publicMethods = array_filter($methods, fn($m) => $m->getName() !== '__construct');

        $this->assertCount(4, $publicMethods);
    }
}
