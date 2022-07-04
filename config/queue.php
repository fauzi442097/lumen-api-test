<?php

return [

    'connections' => [
        'database' => [
            'driver' => 'mongodb',
            // You can also specify your jobs specific database created on config/database.php
            'connection' => 'mongodb',
            'table' => 'jobs',
            'queue' => 'default',
            'expire' => 60,
        ],
    ],

    'failed' => [
        'driver' => 'mongodb',
        // You can also specify your jobs specific database created on config/database.php
        'database' => env('DB_CONNECTION', 'mongodb'),
        'table' => 'failed_jobs',
    ],

];
