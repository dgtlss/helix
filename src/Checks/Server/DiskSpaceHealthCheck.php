<?php

namespace Dgtlss\Helix\Checks\Server;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;

class DiskSpaceHealthCheck implements HealthCheck
{
    protected $thresholdWarning = 20; // Warning if below 20%
    protected $thresholdCritical = 10; // Critical if below 10%

    public function check(): HealthCheckResult
    {
        $diskFree = disk_free_space("/"); // Get free disk space in bytes
        $diskTotal = disk_total_space("/"); // Get total disk space in bytes
        $diskFreePercentage = ($diskFree / $diskTotal) * 100; // Calculate free disk space as a percentage

        if ($diskFreePercentage < $this->thresholdCritical) {
            // Disk space is critically low
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Disk space is critically low.',
                sprintf('Only %.2f%% of disk space remaining.', $diskFreePercentage)
            );
        } elseif ($diskFreePercentage < $this->thresholdWarning) {
            // Disk space is low
            return new HealthCheckResult(
                HealthCheckResult::STATUS_WARNING,
                'Disk space is low.',
                sprintf('Only %.2f%% of disk space remaining.', $diskFreePercentage)
            );
        } else {
            // Disk space is sufficient
            return new HealthCheckResult(
                HealthCheckResult::STATUS_OK,
                'Disk space is sufficient.',
                sprintf('%.2f%% of disk space remaining.', $diskFreePercentage)
            );
        }
    }
}