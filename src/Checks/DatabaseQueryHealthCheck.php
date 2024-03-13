<?php

namespace Dgtlss\Helix\Checks;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Illuminate\Support\Facades\DB;
use Exception;

class DatabaseQueryHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Attempt a simple database query to ensure responsiveness
            DB::select(DB::raw('select 1'));

            // If we got this far, the database query execution is operational
            return new HealthCheckResult(
                HealthCheckResult::STATUS_OK,
                'Database query execution is operational.'
            );
        } catch (Exception $exception) {
            // If we got an exception, the database query execution is not operational
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Database query execution failed.',
                $exception->getMessage()
            );
        }
    }
}
