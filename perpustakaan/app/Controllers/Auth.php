<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

helper('cookie'); // Pastikan helper cookie sudah dimuat

class Auth extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store()
    {
        $userModel = new UsersModel();

        // Get input data from the registration form
        $data = [
            'username' => $this->request->getPost('username'), // Ambil username dari form
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash the password for security
            'role' => 'user' // Default role for new users
        ];

        // Define validation rules
        $validationRules = [
            'username' => 'required|alpha_numeric|min_length[3]|is_unique[users.username]', // Validasi untuk username
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]' // Check if password and confirm password match
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, redirect back to the register page with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user data to the database
        $userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
    }

    public function authenticate()
    {
        $userModel = new UsersModel();
        $identifier = $this->request->getPost('identifier');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember'); 

        $user = $userModel->where('email', $identifier)
            ->orWhere('username', $identifier)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            // Simpan cookie jika Remember Me dicentang
            if ($remember) {
                $token = bin2hex(random_bytes(16)); // Token unik untuk Remember Me
                $expireTime = time() + (30 * 24 * 60 * 60); // 30 hari

                // Simpan token ke database atau gunakan fitur user
                $userModel->update($user['id'], ['remember_token' => $token]);

                // Simpan token di cookie
                setcookie('remember_token', $token, $expireTime, "/", "", false, true);
            }

            return redirect()->to('/')->with('message', 'Login sukses');
        } else {
            return redirect()->back()->with('error', 'Invalid username/email or password');
        }
    }

    public function logout()
    {
        session()->destroy();

        // Hapus cookie Remember Me
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, "/", "", false, true);
        }

        return redirect()->to('/login')->with('message', 'You have logged out');
    }
}
