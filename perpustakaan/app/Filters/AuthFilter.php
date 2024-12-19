<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UsersModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika belum login, cek cookie "remember_token"
        if (!$session->get('logged_in')) {
            if (isset($_COOKIE['remember_token'])) {
                $userModel = new UsersModel();
                $token = $_COOKIE['remember_token'];

                // Cari user berdasarkan remember_token
                $user = $userModel->where('remember_token', $token)->first();

                if ($user) {
                    // Login otomatis dengan mengisi session
                    $session->set([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'logged_in' => true
                    ]);
                } else {
                    // Jika token tidak valid, hapus cookie
                    setcookie('remember_token', '', time() - 3600, '/');
                }
            } else {
                // Jika tidak ada session dan cookie, redirect ke login
                return redirect()->to('/login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after
    }
}
