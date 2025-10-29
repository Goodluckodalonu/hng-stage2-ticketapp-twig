<?php
function isAuthenticated() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
}

function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}

function requireAuth() {
    if (!isAuthenticated()) {
        $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
        $_SESSION['toast'] = [
            'message' => 'Your session has expired — please log in again.',
            'type' => 'error'
        ];
        header('Location: /login');
        exit;
    }
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function loadUsers() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $data = file_get_contents(USERS_FILE);
    return json_decode($data, true) ?: [];
}

function saveUsers($users) {
    return file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function loadTickets() {
    if (!file_exists(TICKETS_FILE)) {
        return [];
    }
    $data = file_get_contents(TICKETS_FILE);
    $tickets = json_decode($data, true) ?: [];
    
    // Filter by current user if logged in
    if (isAuthenticated()) {
        $userId = $_SESSION['user']['id'];
        return array_filter($tickets, function($ticket) use ($userId) {
            return $ticket['userId'] == $userId;
        });
    }
    
    return [];
}

function saveTickets($tickets) {
    // For user-specific operations, we need to handle all tickets
    $allTickets = [];
    if (file_exists(TICKETS_FILE)) {
        $data = file_get_contents(TICKETS_FILE);
        $allTickets = json_decode($data, true) ?: [];
    }
    
    // If we're saving user-specific tickets, merge them
    if (isAuthenticated()) {
        $userId = $_SESSION['user']['id'];
        // Remove user's old tickets
        $allTickets = array_filter($allTickets, function($ticket) use ($userId) {
            return $ticket['userId'] != $userId;
        });
        // Add user's new tickets
        $allTickets = array_merge($allTickets, $tickets);
    }
    
    return file_put_contents(TICKETS_FILE, json_encode($allTickets, JSON_PRETTY_PRINT));
}

function showToast($message, $type = 'success') {
    $_SESSION['toast'] = [
        'message' => $message,
        'type' => $type
    ];
}

function getToast() {
    $toast = $_SESSION['toast'] ?? null;
    unset($_SESSION['toast']);
    return $toast;
}
?>