<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function showLogin(): void
    {
        if (isset($_SESSION['user_id'])) {
            redirect('/admin');
        }
        render('auth/login', ['title' => 'Login Admin - My Store'], 'auth');
    }

    public function login(): void
    {
        csrf_verify();
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = (new User(db()))->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            redirect('/admin');
        }

        flash('error', 'Username atau password salah.');
        $_SESSION['old_username'] = $username;
        redirect('/login');
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        session_start();
        flash('success', 'Anda berhasil logout.');
        redirect('/login');
    }
}
