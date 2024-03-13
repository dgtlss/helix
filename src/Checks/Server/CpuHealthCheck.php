<?php

namespace Dgtlss\Helix\Checks\Server;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;

class CpuHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Get system load averages
            $loadAverages = sys_getloadavg();
            if ($loadAverages === false) {
                throw new \Exception('Unable to fetch system load averages.');
            }

            $cpuCoreCount = $this->getCpuCoreCount(); // Get the number of CPU cores
            $oneMinuteLoad = $loadAverages[0]; // Get the 1-minute load average

            // Calculate load percentage
            $loadPercentage = ($oneMinuteLoad / $cpuCoreCount) * 100;

            // Define thresholds
            $warningThreshold = 70; // Adjust based on your needs
            $criticalThreshold = 90; // Adjust based on your needs

            if ($loadPercentage >= $criticalThreshold) {
                // If the load is above the critical threshold, return a critical status
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_CRITICAL,
                    'CPU load is critically high.',
                    ['load_percentage' => $loadPercentage]
                );
            } elseif ($loadPercentage >= $warningThreshold) {
                // If the load is between the warning and critical thresholds, return a warning status
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_WARNING,
                    'CPU load is high.',
                    ['load_percentage' => $loadPercentage]
                );
            } else {
                // If the load is below the warning threshold, return an OK status
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_OK,
                    'CPU load is within acceptable limits.',
                    ['load_percentage' => $loadPercentage]
                );
            }
        } catch (\Exception $exception) {
            // Catch any exceptions that occur during the CPU usage check
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Failed to perform CPU usage check.',
                ['error' => $exception->getMessage()]
            );
        }
    }

    private function getCpuCoreCount(): int
    {
        // Attempt to get the number of CPU cores
        // This method and command might need adjustment based on the operating system
        $command = "nproc";
        $coreCount = intval(shell_exec($command));

        return $coreCount > 0 ? $coreCount : 1; // Ensure there's at least one core reported
    }
}