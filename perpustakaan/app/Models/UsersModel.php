<?php
namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'role', 'username', 'remember_token'];

    // Fungsi untuk mengambil data pengguna berdasarkan email
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    // Fungsi untuk mengambil data pengguna berdasarkan username
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    // Fungsi untuk mengambil data pengguna berdasarkan remember_token
    public function getUserByRememberToken($token)
    {
        return $this->where('remember_token', $token)->first();
    }

    // Fungsi untuk menyimpan atau memperbarui remember_token
    public function updateRememberToken($userId, $token)
    {
        return $this->update($userId, ['remember_token' => $token]);
    }
}
