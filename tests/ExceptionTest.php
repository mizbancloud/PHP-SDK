<?php

declare(strict_types=1);

namespace MizbanCloud\Tests;

use PHPUnit\Framework\TestCase;
use MizbanCloud\Exceptions\MizbanCloudException;

class ExceptionTest extends TestCase
{
    public function testExceptionWithMessage(): void
    {
        $exception = new MizbanCloudException('Test error message');

        $this->assertEquals('Test error message', $exception->getMessage());
    }

    public function testExceptionWithStatusCode(): void
    {
        $exception = new MizbanCloudException('Error', 404);

        $this->assertEquals(404, $exception->getStatusCode());
    }

    public function testExceptionWithResponse(): void
    {
        $response = [
            'success' => false,
            'message' => 'Not found',
            'data' => null,
        ];

        $exception = new MizbanCloudException('Error', 404, $response);

        $this->assertEquals($response, $exception->getResponse());
    }

    public function testExceptionWithFields(): void
    {
        $response = [
            'success' => false,
            'message' => 'Validation failed',
            'fields' => ['email' => 'Invalid email format'],
        ];

        $exception = new MizbanCloudException('Validation failed', 422, $response);

        $this->assertEquals(['email' => 'Invalid email format'], $exception->getFields());
    }

    public function testExceptionWithInvalidFields(): void
    {
        $response = [
            'success' => false,
            'message' => 'Validation failed',
            'invalidFields' => ['email', 'password'],
        ];

        $exception = new MizbanCloudException('Validation failed', 422, $response);

        $this->assertEquals(['email', 'password'], $exception->getInvalidFields());
    }

    public function testExceptionWithMissingFields(): void
    {
        $response = [
            'success' => false,
            'message' => 'Validation failed',
            'missing_fields' => ['name', 'address'],
        ];

        $exception = new MizbanCloudException('Validation failed', 422, $response);

        $this->assertEquals(['name', 'address'], $exception->getMissingFields());
    }

    public function testExceptionWithPreviousException(): void
    {
        $previous = new \Exception('Previous error');
        $exception = new MizbanCloudException('Current error', 500, null, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testExceptionDefaultStatusCode(): void
    {
        $exception = new MizbanCloudException('Error');

        $this->assertEquals(0, $exception->getStatusCode());
    }

    public function testExceptionNullResponse(): void
    {
        $exception = new MizbanCloudException('Error', 500);

        $this->assertNull($exception->getResponse());
        $this->assertNull($exception->getFields());
        $this->assertNull($exception->getInvalidFields());
        $this->assertNull($exception->getMissingFields());
    }

    public function testExceptionAllFieldTypes(): void
    {
        $response = [
            'success' => false,
            'message' => 'Complete validation error',
            'fields' => ['email' => 'Invalid'],
            'invalidFields' => ['email'],
            'missing_fields' => ['phone'],
        ];

        $exception = new MizbanCloudException('Complete validation error', 422, $response);

        $this->assertEquals(['email' => 'Invalid'], $exception->getFields());
        $this->assertEquals(['email'], $exception->getInvalidFields());
        $this->assertEquals(['phone'], $exception->getMissingFields());
    }
}
