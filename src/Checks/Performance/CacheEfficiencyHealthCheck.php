<?php

namespace Dgtlss\Helix\Checks\Performance;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Illuminate\Support\Facades\Cache;
use Exception;

class CacheEfficiencyHealthCheck implements HealthCheck
{
    protected $threshold = 50; // Maximum acceptable cache operation time in milliseconds

    public function check(): HealthCheckResult
    {
        try {
            // Key and value to test cache operation
            $key = 'helix-cache-efficiency-test';
            $value = 'helix-cache-efficiency-test-value';

            // Measure write time
            $start = microtime(true);
            Cache::put($key, $value, now()->addMinutes(5));
            $end = microtime(true);
            $writeTime = ($end - $start) * 1000; // Convert to milliseconds

            // Measure read time
            $start = microtime(true);
            $retrievedValue = Cache::get($key);
            $end = microtime(true);
            $readTime = ($end - $start) * 1000; // Convert to milliseconds

            // Check if the write and read times are within the acceptable threshold
            if ($writeTime <= $this->threshold && $readTime <= $this->threshold && $retrievedValue === $value) {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_OK,
                    'Cache operations are within acceptable performance limits.',
                    ['write_time_ms' => $writeTime, 'read_time_ms' => $readTime]
                );
            } else {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_WARNING,
                    'Cache operations are slower than expected.',
                    ['write_time_ms' => $writeTime, 'read_time_ms' => $readTime]
                );
            }
        } catch (Exception $exception) {
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Failed to perform cache efficiency check.',
                ['error' => $exception->getMessage()]
            );
        }
    }
}