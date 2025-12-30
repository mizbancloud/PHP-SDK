<?php

declare(strict_types=1);

namespace MizbanCloud\Modules;

use MizbanCloud\HttpClient;

/**
 * Statics Module
 *
 * Catalog data: datacenters, operating systems, cache times, sliders.
 */
class Statics
{
    public function __construct(
        private readonly HttpClient $client
    ) {}

    /**
     * List all available datacenters
     * Returns datacenter options for server creation
     */
    public function listDatacenters(): array
    {
        return $this->client->get('/api/v1/static/datacenters');
    }

    /**
     * List all available operating systems
     * Returns OS options for server creation
     */
    public function listOperatingSystems(): array
    {
        return $this->client->get('/api/v1/static/os-list');
    }

    /**
     * Get cache time options
     * Returns predefined cache TTL options
     */
    public function getCacheTimes(): array
    {
        return $this->client->get('/api/v1/static/cache-times');
    }

    /**
     * Get promotional sliders/banners
     */
    public function getSliders(): array
    {
        return $this->client->get('/api/v1/static/sliders');
    }
}
