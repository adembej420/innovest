<?php
// Authentication configuration
return [
    // Session settings
    'session' => [
        'timeout' => 3600, // 1 hour inactivity timeout
        'name' => 'secure_session',
        'cookie_params' => [
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => true, // Enable in production (HTTPS)
            'httponly' => true,
            'samesite' => 'Strict'
        ]
    ],
    
    // Password requirements
    'password' => [
        'min_length' => 8,
        'require_numbers' => true,
        'require_special_chars' => true
    ],
    
    // Admin protection
    'admin' => [
        'ip_whitelist' => [], // Add trusted IPs if needed
        '2fa_required' => false // Enable for production
    ]
];