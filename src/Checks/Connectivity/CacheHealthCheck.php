<?php

namespace Dgtlss\Helix\Checks\Connectivity;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Illuminate\Support\Facades\Cache;
use Exception;

class CacheHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Attempt to write a test value to the cache
            $cacheKey = 'helix-cache-health-check-test';
            $cacheValue = 'helix-cache-health-check-test-value';
            Cache::put($cacheKey, $cacheValue, now()->addMinutes(1));

            // Attempt to read the test value from the cache
            $retrievedValue = Cache::get($cacheKey);

            // Verify that the retrieved value matches the expected test value
            if ($retrievedValue === $cacheValue) {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_OK,
                    'Cache system is operational.'
                );
            } else {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_CRITICAL,
                    'Cache system failed to retrieve the expected value.'
                );
            }
        } catch (Exception $exception) {
            // Catch any exceptions that occur during the cache test
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Cache system test failed.',
                $exception->getMessage()
            );
        }
    }
}