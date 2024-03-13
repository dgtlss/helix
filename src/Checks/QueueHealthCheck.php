<?php

namespace Dgtlss\Helix\Checks;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Dgtlss\Helix\Jobs\QueueHealthCheckJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Exception;

class QueueHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Dispatch the health check job
            Queue::push(new QueueHealthCheckJob());

            // Sleep briefly to allow for queue processing
            // Note: This delay might need to be adjusted based on your queue's latency
            sleep(5); // Sleep for 5 seconds

            // Check if the job has updated the cache
            if (Cache::has('queue-health-check')) {
                // If the job updated the cache, the queue system is operational
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_OK,
                    'Queue system is operational.'
                );
            } else {
                // If the job did not update the cache, the queue system may be delayed or non-operational
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_WARNING,
                    'Queue system may be delayed or non-operational.'
                );
            }
        } catch (Exception $exception) {
            // Catch any exceptions that occur during the queue test
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Queue system test failed.',
                $exception->getMessage()
            );
        }
    }
}