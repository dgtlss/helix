<?php

namespace Dgtlss\Helix\Checks\Connectivity;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Illuminate\Support\Facades\DB;
use Exception;

class DatabaseConnectivityHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Attempt to get the PDO instance to check database connectivity
            DB::connection()->getPdo();
            
            // If we got this far, the database connection is operational
            $result = new HealthCheckResult(
                HealthCheckResult::STATUS_OK,
                'Database connectivity is operational.'
            );
        } catch (Exception $exception) {
            // If we got an exception, the database connection is not operational
            $result = new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Failed to establish database connection.',
                $exception->getMessage()
            );
        }

        
    }
}
