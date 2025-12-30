<?php

declare(strict_types=1);

namespace MizbanCloud\Exceptions;

use Exception;
use Throwable;

/**
 * MizbanCloud SDK Exception
 *
 * Thrown when API requests fail or return errors.
 */
class MizbanCloudException extends Exception
{
    protected int $statusCode;
    protected ?array $fields;
    protected ?array $invalidFields;
    protected ?array $missingFields;
    protected ?array $response;

    public function __construct(
        string $message,
        int $statusCode = 0,
        ?array $response = null,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $statusCode, $previous);

        $this->statusCode = $statusCode;
        $this->response = $response;
        $this->fields = $response['fields'] ?? null;
        $this->invalidFields = $response['invalidFields'] ?? null;
        $this->missingFields = $response['missing_fields'] ?? null;
    }

    /**
     * Get HTTP status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get fields with errors
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * Get invalid fields
     */
    public function getInvalidFields(): ?array
    {
        return $this->invalidFields;
    }

    /**
     * Get missing fields
     */
    public function getMissingFields(): ?array
    {
        return $this->missingFields;
    }

    /**
     * Get full response array
     */
    public function getResponse(): ?array
    {
        return $this->response;
    }
}
