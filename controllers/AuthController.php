<?php
class AuthController extends BaseController {
    public function showLogin($twig) {
        if (isAuthenticated()) {
            redirect('/dashboard');
        }
        $this->render($twig, 'login.twig');
    }
    
    public function showSignup($twig) {
        if (isAuthenticated()) {
            redirect('/dashboard');
        }
        $this->render($twig, 'signup.twig');
    }
    
    public function login($twig) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            showToast('Please fill in all fields', 'error');
            $this->render($twig, 'login.twig', [
                'email' => $email
            ]);
            return;
        }
        
        $users = loadUsers();
        $user = null;
        
        foreach ($users as $u) {
            if ($u['email'] === $email && $u['password'] === $password) {
                $user = $u;
                break;
            }
        }
        
        if ($user) {
            $_SESSION['user'] = $user;
            showToast('Login successful!', 'success');
            
            $redirect = $_SESSION['redirect'] ?? '/dashboard';
            unset($_SESSION['redirect']);
            redirect($redirect);
        } else {
            showToast('Invalid credentials. Please check your email and password.', 'error');
            $this->render($twig, 'login.twig', [
                'email' => $email
            ]);
        }
    }
    
    public function signup($twig) {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        
        // Validation
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            showToast('Please fill in all fields', 'error');
            $this->render($twig, 'signup.twig', [
                'name' => $name,
                'email' => $email
            ]);
            return;
        }
        
        if ($password !== $confirmPassword) {
            showToast('Passwords do not match', 'error');
            $this->render($twig, 'signup.twig', [
                'name' => $name,
                'email' => $email
            ]);
            return;
        }
        
        $users = loadUsers();
        
        // Check if user already exists
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                showToast('User with this email already exists', 'error');
                $this->render($twig, 'signup.twig', [
                    'name' => $name,
                    'email' => $email
                ]);
                return;
            }
        }
        
        // Create new user
        $newUser = [
            'id' => time(),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'createdAt' => date('c')
        ];
        
        $users[] = $newUser;
        
        if (saveUsers($users)) {
            $_SESSION['user'] = $newUser;
            showToast('Account created successfully!', 'success');
            redirect('/dashboard');
        } else {
            showToast('Failed to create account. Please try again.', 'error');
            $this->render($twig, 'signup.twig', [
                'name' => $name,
                'email' => $email
            ]);
        }
    }
    
    public function logout() {
        session_destroy();
        showToast('Logged out successfully', 'success');
        redirect('/');
    }
}
?>