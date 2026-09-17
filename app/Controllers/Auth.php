<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/beranda');
        }

        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel
            ->where('username', $username)
            ->where('status', 'aktif')
         ->first();

        if (!$admin || $password !== $admin['password']) {
         return redirect()
                ->back()
                ->with('error', 'Username atau password salah.');
        }

        session()->set([
            'id_admin'  => $admin['id_admin'],
            'nama'      => $admin['nama'],
            'username'  => $admin['username'],
            'logged_in' => true
        ]);

        return redirect()->to('/beranda');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}