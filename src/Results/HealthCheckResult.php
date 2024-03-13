<?php

namespace Dgtlss\Helix\Results;

class HealthCheckResult
{
    public const STATUS_OK = 'OK';
    public const STATUS_WARNING = 'WARNING';
    public const STATUS_CRITICAL = 'CRITICAL';

    /**
     * The status of the health check.
     *
     * @var string
     */
    public $status;

    /**
     * A message describing the result of the health check.
     *
     * @var string
     */
    public $message;

    /**
     * Optional additional data related to the health check result.
     *
     * @var mixed
     */
    public $data;

    /**
     * HealthCheckResult constructor.
     *
     * @param string $status
     * @param string $message
     * @param mixed $data Optional.
     */
    public function __construct(string $status, string $message, $data = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}
