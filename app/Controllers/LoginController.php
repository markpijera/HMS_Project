<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email || !$password) {
            session()->setFlashdata('error', 'Email and password are required');
            return redirect()->back();
        }

        $user = $this->userModel->verifyCredentials($email, $password);

        if ($user && $user['status'] === 'active') {
            // Update last login
            $this->userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);

            // Set session
            session()->set('user', $user);

            // Redirect to dashboard
            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
