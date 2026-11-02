<?php
class AuthMiddleware
{
    public static function handle(): void
    {
        if (!isset($_SESSION['user_id'])) {
            flash('error', 'Silakan login terlebih dahulu.');
            redirect('/login');
        }
    }
}
