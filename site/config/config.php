<?php

return [
    'debug' => false,
    'stripe' => [
        'secretKey' => getenv('STRIPE_SECRET_KEY') ?: 'sk_test_51TqNbBBiWcX3qDTRow1r0lHLHJsT6sRyiPXcMriiuEAAY96NzFPvvF979lfadL8Ydmtg8P64fbpxnS3Bp5uaYh8R00sf9j7Oy5',
        'webhookSecret' => getenv('STRIPE_WEBHOOK_SECRET') ?: 'whsec_de52aa4b0e853685156096f784d9b4935da6e554cc4c8c20bf58ac560b52af09',
    ]

    // 'panel' => [
    //     'css' => 'assets/panel.css'
    // ]
];