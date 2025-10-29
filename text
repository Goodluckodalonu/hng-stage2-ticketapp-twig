<?php
require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'config/helpers.php';

session_start();

// Manual autoloader for controllers
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Initializee Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Set to 'cache' in production
    'debug' => true
]);

// Add custom functions to Twig
$twig->addFunction(new \Twig\TwigFunction('isAuthenticated', 'isAuthenticated'));
$twig->addFunction(new \Twig\TwigFunction('getCurrentUser', 'getCurrentUser'));

// Route handling
$path = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($path, PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Simple routing
switch ($path) {
    case '/':
        $controller = new LandingController();
        $controller->index($twig);
        break;
        
    case '/login':
        $controller = new AuthController();
        if ($method === 'GET') {
            $controller->showLogin($twig);
        } else {
            $controller->login($twig);
        }
        break;
        
    case '/signup':
        $controller = new AuthController();
        if ($method === 'GET') {
            $controller->showSignup($twig);
        } else {
            $controller->signup($twig);
        }
        break;
        
    case '/dashboard':
        requireAuth();
        $controller = new DashboardController();
        $controller->index($twig);
        break;
        
    case '/tickets':
        requireAuth();
        $controller = new TicketController();
        if ($method === 'GET') {
            $controller->index($twig);
        } else {
            $controller->handlePost($twig);
        }
        break;
        
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case '/tickets/delete':
        requireAuth();
        if ($method === 'POST') {
            $controller = new TicketController();
            $controller->delete($twig);
        }
        break;
        
    default:
        http_response_code(404);
        echo "Page not found";
        break;
}
?>