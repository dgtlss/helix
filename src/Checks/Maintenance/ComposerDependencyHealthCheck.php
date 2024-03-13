<?php

namespace Dgtlss\Helix\Checks\Maintenance;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Enlightn\SecurityChecker\SecurityChecker;
use Exception;


class ComposerPackagesUpdateHealthCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            $checker = new SecurityChecker();
            // Specify the path to your composer.lock file. Usually, it's at the base of your project.
            $path = base_path('composer.lock');
            $vulnerabilities = $checker->check($path);

            if (count($vulnerabilities) > 0) {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_WARNING,
                    'Found vulnerabilities in composer dependencies.',
                    json_encode($vulnerabilities) // You might want to format this data more cleanly
                );
            } else {
                return new HealthCheckResult(
                    HealthCheckResult::STATUS_OK,
                    'No known vulnerabilities in composer dependencies.'
                );
            }
        } catch (Exception $exception) {
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Failed to check composer dependencies for vulnerabilities.',
                $exception->getMessage()
            );
        }
    }
}