<?php
// Application configuration
define('APP_NAME', 'TicketApp');
define('APP_VERSION', '1.0.0');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');

// Data file paths
define('USERS_FILE', __DIR__ . '/../data/users.json');
define('TICKETS_FILE', __DIR__ . '/../data/tickets.json');

// Ensure data directory exists
if (!file_exists(dirname(USERS_FILE))) {
    mkdir(dirname(USERS_FILE), 0755, true);
}

// Initialize data files if they don't exist
if (!file_exists(USERS_FILE)) {
    file_put_contents(USERS_FILE, json_encode([]));
}
if (!file_exists(TICKETS_FILE)) {
    file_put_contents(TICKETS_FILE, json_encode([]));
}
?>