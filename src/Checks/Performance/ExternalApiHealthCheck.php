<?php

namespace Dgtlss\Helix\Checks\Performance;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class ExternalApiHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        // Check that the user has allowed external api health checks
        if (config('helix.external_api_health_check') === true) {
            
        }
    }
}