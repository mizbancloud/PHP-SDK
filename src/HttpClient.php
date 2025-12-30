<?php

declare(strict_types=1);

namespace MizbanCloud;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use MizbanCloud\Exceptions\MizbanCloudException;

/**
 * HTTP Client for MizbanCloud API
 */
class HttpClient
{
    private Client $client;
    private ?string $token = null;
    private string $language;
    private string $baseUrl;
    private int $timeout;

    public function __construct(array $config = [])
    {
        $this->baseUrl = $config['baseUrl'] ?? 'https://auth.mizbancloud.com';
        $this->timeout = $config['timeout'] ?? 30;
        $this->language = $config['language'] ?? 'en';

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
            'headers' => array_merge([
                'Accept' => 'application/json',
                'Accept-Language' => $this->language,
            ], $config['headers'] ?? []),
        ]);
    }

    /**
     * Set authentication token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * Get current token
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set language for API responses
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * Get current language
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Make API request
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path API endpoint path
     * @param array $data Request data
     * @param array $options Additional request options
     * @return array API response
     * @throws MizbanCloudException
     */
    public function request(string $method, string $path, array $data = [], array $options = []): array
    {
        $requestOptions = [
            'headers' => [
                'Accept-Language' => $this->language,
            ],
        ];

        // Add authorization header if token is set
        if ($this->token !== null) {
            $requestOptions['headers']['Authorization'] = 'Bearer ' . $this->token;
        }

        // Add custom headers
        if (isset($options['headers'])) {
            $requestOptions['headers'] = array_merge($requestOptions['headers'], $options['headers']);
        }

        // Add timeout if specified
        if (isset($options['timeout'])) {
            $requestOptions['timeout'] = $options['timeout'];
        }

        // Add data based on method
        if ($method === 'GET') {
            if (!empty($data)) {
                $requestOptions['query'] = $data;
            }
        } else {
            $requestOptions['form_params'] = $data;
        }

        try {
            $response = $this->client->request($method, $path, $requestOptions);
            $body = json_decode($response->getBody()->getContents(), true);

            // Check for API-level errors (success: false with 2xx status)
            if (isset($body['success']) && $body['success'] === false) {
                throw new MizbanCloudException(
                    $body['message'] ?? 'Operation failed',
                    $response->getStatusCode(),
                    $body
                );
            }

            return $body;
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $statusCode = $response ? $response->getStatusCode() : 0;
            $body = null;

            if ($response) {
                $body = json_decode($response->getBody()->getContents(), true);
            }

            throw new MizbanCloudException(
                $body['message'] ?? $e->getMessage(),
                $statusCode,
                $body,
                $e
            );
        } catch (GuzzleException $e) {
            throw new MizbanCloudException(
                $e->getMessage(),
                0,
                null,
                $e
            );
        }
    }

    /**
     * Make GET request
     */
    public function get(string $path, array $data = [], array $options = []): array
    {
        return $this->request('GET', $path, $data, $options);
    }

    /**
     * Make POST request
     */
    public function post(string $path, array $data = [], array $options = []): array
    {
        return $this->request('POST', $path, $data, $options);
    }

    /**
     * Make PUT request
     */
    public function put(string $path, array $data = [], array $options = []): array
    {
        return $this->request('PUT', $path, $data, $options);
    }

    /**
     * Make DELETE request
     */
    public function delete(string $path, array $data = [], array $options = []): array
    {
        return $this->request('DELETE', $path, $data, $options);
    }
}
