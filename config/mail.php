<?php
// Mail configuration for development environment using MailHog
return [
    'host' => 'localhost',     // MailHog SMTP host
    'port' => 1025,           // MailHog SMTP port
    'username' => '',         // No authentication needed for MailHog
    'password' => '',         // No authentication needed for MailHog
    'encryption' => '',       // No encryption needed for MailHog
    'from_address' => 'noreply@yourdomain.com',
    'from_name' => 'User Management System',
    'debug' => true          // Enable debug mode in development
]; 