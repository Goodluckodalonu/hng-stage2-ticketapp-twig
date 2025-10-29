<?php
class BaseController {
    protected function render($twig, $template, $data = []) {
        // Make sure config constants are defined
        if (!defined('APP_NAME')) {
            define('APP_NAME', 'TicketApp');
        }
        
        $defaultData = [
            'app_name' => APP_NAME,
            'current_user' => getCurrentUser(),
            'toast' => getToast()
        ];
        
        echo $twig->render($template, array_merge($defaultData, $data));
    }
    
    protected function validateTicketData($data) {
        $errors = [];
        
        if (empty(trim($data['title']))) {
            $errors['title'] = 'Title is required';
        }
        
        if (empty($data['status']) || !in_array($data['status'], ['open', 'in_progress', 'closed'])) {
            $errors['status'] = 'Valid status is required';
        }
        
        return $errors;
    }
}
?>