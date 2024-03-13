<?php

namespace Dgtlss\Helix\Checks\Maintenance;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Exception;

class ComposerPackagesUpdateHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Initialize the Composer 'outdated' command process
            $process = new Process(['composer', 'outdated', '--direct', '--no-interaction']);
            $process->setWorkingDirectory(base_path()); // Ensure we're in the project root
            $process->run();

            // Executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();
            if (empty($output)) {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_OK,
                    'All direct composer packages are up to date.'
                );
            } else {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_WARNING,
                    'Some direct composer packages need updates.',
                    $output // Output the list of outdated packages
                );
            }
        } catch (Exception $exception) {
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Failed to check for composer package updates.',
                $exception->getMessage()
            );
        }
    }
}