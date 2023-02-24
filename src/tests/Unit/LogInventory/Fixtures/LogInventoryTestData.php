<?php

return [
    'file_lines' => [
        'order-service - [17/Sep/2022:10:21:53] "POST /orders HTTP/1.1" 201',
        'order-service - [17/Sep/2022:10:23:54] "POST /orders HTTP/1.1" 422'
    ],
    'set_result' => [
        [
            'service_name' => 'order-service',
            'log_time' => 1663410113,
            'verb' => 'POST',
            'url' => '/orders',
            'protocol' => 'HTTP/1.1',
            'status' => 201

        ],
        [
            'service_name' => 'order-service',
            'log_time' => 1663410234,
            'verb' => 'POST',
            'url' => '/orders',
            'protocol' => 'HTTP/1.1',
            'status' => 422
        ]
    ]
];
