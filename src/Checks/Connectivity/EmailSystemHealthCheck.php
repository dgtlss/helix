<?php

namespace Dgtlss\Helix\Checks\Connectivity;

use Dgtlss\Helix\Contracts\HealthCheck;
use Dgtlss\Helix\Results\HealthCheckResult;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;
use Exception;

class EmailSystemCheck implements HealthCheck
{
    public function check(): HealthCheckResult
    {
        try {
            // Attempt to get the transport instance and start it to check connectivity
            $transport = Mail::getSwiftMailer()->getTransport();
            $transport->start();

            // If we got this far, the email system connectivity is operational
            return new HealthCheckResult(
                HealthCheckResult::STATUS_OK,
                'Email system connectivity is operational.'
            );
        } catch (Swift_TransportException $exception) {
            // If we got an exception, the email system connectivity is not operational
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'Email system connectivity failed.',
                $exception->getMessage()
            );
        } catch (\Exception $exception) {
            // Catch any other exceptions that might occur
            return new HealthCheckResult(
                HealthCheckResult::STATUS_CRITICAL,
                'An unexpected error occurred while checking email system connectivity.',
                $exception->getMessage()
            );
        }
    }
}