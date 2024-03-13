<?php

namespace Dgtlss\Helix\Contracts;

use Dgtlss\Helix\Results\HealthCheckResult;

interface HealthCheck
{
    /**
     * Perform the health check and return the result.
     *
     * @return HealthCheckResult
     */
    public function check(): HealthCheckResult;
}
