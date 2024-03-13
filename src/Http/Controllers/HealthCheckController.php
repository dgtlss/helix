<?php

namespace Dgtlss\Helix;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Dgtlss\Helix\Checks\Connectivity\EmailSystemHealthCheck;
use Dgtlss\Helix\Checks\Connectivity\DatabaseConnectivityHealthCheck;
use Dgtlss\Helix\Checks\Connectivity\DatabaseQueryHealthCheck;
use Dgtlss\Helix\Checks\Connectivity\CacheHealthCheck;
use Dgtlss\Helix\Checks\Connectivity\QueueHealthCheck;

class HealthCheckController extends Controller
{
    public function index()
    {
        $results = [];

        // Instantiate and run each health check
        $checks = [
            new DatabaseConnectivityHealthCheck(),
            new EmailSystemHealthCheck(),
        ];

        foreach ($checks as $check) {
            $results[] = $check->check();
        }

        // Format and return the results
        // For simplicity, we're returning a JSON response here
        return Response::json(['healthChecks' => $results]);
    }
}