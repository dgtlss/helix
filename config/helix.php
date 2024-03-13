<?php
/*
 * Helix v1.0.0
 *
 * (c) Nathan Langer (dgtlss) <nathanlanger@googlemail.com> 2023-2024
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

return[

    /*
    |--------------------------------------------------------------------------
    | Alerting
    |--------------------------------------------------------------------------
    |
    | Helix can send alerts to a variety of channels when a health check fails.
    | If you want to use this feature, set this to true.
    | You will also need to specify the channels you want to use.
    |
    */

    'alerting' => false,

    'alerting_channels' => [
        // 'slack' => [
        //     'webhook_url' => 'https://hooks.slack.com/services/your-webhook-url',
        //     'channel' => '#helix-alerts',
        //     'username' => 'Helix',
        //     'icon' => ':helix:',
        // ],
        // 'discord' => [
        //     'webhook_url' => 'https://discord.com/api/webhooks/your-webhook-url',
        //     'username' => 'Helix',
        //     'avatar' => 'https://laravelhelix.co/helix.png',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | External API Health Check
    |--------------------------------------------------------------------------
    |
    | Helix can check the performance of external API's
    | If you want to use this feature, set this to true.
    |
    */

    'external_api_health_check' => true,

    /* 
    |--------------------------------------------------------------------------
    | External Api's
    |--------------------------------------------------------------------------
    |
    | For helix to check the performance of external API's, you need to provide the URL's
    | of the API's you want to check, as well as the expected response time in milliseconds.
    | You will also need to provide any credentials required to access the API's.
    |
    */

    'external_apis' => [
        // 'example' => [
        //     'url' => 'https://laravelhelix.co/api/generichealthcheck',
        //     'expected_response_time' => 1000,
        //     'credentials' => [
        //         'secret' => 'secret',
        //         'key' => 'key',
        //         'token' => 'token',
        //     ]
        // ]
    ],
];