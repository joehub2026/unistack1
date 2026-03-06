<?php
// ============================================================
// UniStack — Auth Controller
// ============================================================
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    public static function showLogin(): void {
        require_once __DIR__ . '/../views/shared/login.php';
    }

    public static function showRegister(): void {
        require_once __DIR__ . '/../views/shared/register.php';
    }

    public static function login(): void {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            setFlash('error', 'Please fill in all fields.');
            header('Location: ' . BASE_URL . '/login.php');
            exit;
        }

        $user = UserModel::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            setFlash('error', 'Invalid email or password.');
            header('Location: ' . BASE_URL . '/login.php');
            exit;
        }

        if (!$user['is_active']) {
            setFlash('error', 'Your account has been deactivated. Contact admin.');
            header('Location: ' . BASE_URL . '/login.php');
            exit;
        }

        startSession();
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email']     = $user['email'];
        $_SESSION['role']      = $user['role'];

        // Redirect by role
        $redirect = match($user['role']) {
            'admin'     => BASE_URL . '/admin/dashboard.php',
            'moderator' => BASE_URL . '/moderator/dashboard.php',
            default     => BASE_URL . '/board.php',
        };

        header('Location: ' . $redirect);
        exit;
    }

    public static function register(): void {
        $fullName  = trim($_POST['full_name'] ?? '');
        $email     = trim(strtolower($_POST['email'] ?? ''));
        $password  = $_POST['password'] ?? '';
        $confirm   = $_POST['confirm_password'] ?? '';

        if (!$fullName || !$email || !$password || !$confirm) {
            setFlash('error', 'All fields are required.');
            header('Location: ' . BASE_URL . '/register.php');
            exit;
        }

        if (!validateSchoolEmail($email)) {
            setFlash('error', 'You must use your INES school email (e.g. yourname@ines.ac.rw).');
            header('Location: ' . BASE_URL . '/register.php');
            exit;
        }

        if (strlen($password) < 6) {
            setFlash('error', 'Password must be at least 6 characters.');
            header('Location: ' . BASE_URL . '/register.php');
            exit;
        }

        if ($password !== $confirm) {
            setFlash('error', 'Passwords do not match.');
            header('Location: ' . BASE_URL . '/register.php');
            exit;
        }

        if (UserModel::findByEmail($email)) {
            setFlash('error', 'An account with this email already exists.');
            header('Location: ' . BASE_URL . '/register.php');
            exit;
        }

        $id = UserModel::create($fullName, $email, $password);
        if ($id) {
            setFlash('success', 'Account created! Please log in.');
            header('Location: ' . BASE_URL . '/login.php');
        } else {
            setFlash('error', 'Registration failed. Try again.');
            header('Location: ' . BASE_URL . '/register.php');
        }
        exit;
    }

    public static function logout(): void {
        startSession();
        session_destroy();
        header('Location: ' . BASE_URL . '/login.php');
        exit;
    }
}
