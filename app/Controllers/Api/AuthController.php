<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * User login
     */
    public function login()
    {
        $data = $this->request->getJSON(true);

        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Email and password are required'
            ]);
        }

        $user = $this->userModel->verifyCredentials($data['email'], $data['password']);

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status'  => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        if ($user['status'] !== 'active') {
            return $this->response->setStatusCode(403)->setJSON([
                'status'  => 'error',
                'message' => 'Account is not active'
            ]);
        }

        // Update last login
        $this->userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);

        // Remove password from response
        unset($user['password']);

        // In production, generate JWT token here
        $token = base64_encode($user['id'] . ':' . time());

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Login successful',
            'data'    => [
                'user'  => $user,
                'token' => $token
            ]
        ]);
    }

    /**
     * User registration (admin only)
     */
    public function register()
    {
        $data = $this->request->getJSON(true);

        if ($this->userModel->insert($data)) {
            $user = $this->userModel->find($this->userModel->getInsertID());
            unset($user['password']);

            return $this->response->setStatusCode(201)->setJSON([
                'status'  => 'success',
                'message' => 'User registered successfully',
                'data'    => $user
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Registration failed',
            'errors'  => $this->userModel->errors()
        ]);
    }

    /**
     * Get current user profile
     */
    public function me()
    {
        // In production, get user ID from JWT token
        $userId = $this->request->getGet('user_id');

        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'status'  => 'error',
                'message' => 'Unauthorized'
            ]);
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'User not found'
            ]);
        }

        unset($user['password']);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $user
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile()
    {
        $data = $this->request->getJSON(true);
        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'status'  => 'error',
                'message' => 'Unauthorized'
            ]);
        }

        // Remove sensitive fields
        unset($data['password'], $data['role'], $data['user_id']);

        if ($this->userModel->update($userId, $data)) {
            $user = $this->userModel->find($userId);
            unset($user['password']);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Profile updated successfully',
                'data'    => $user
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Update failed',
            'errors'  => $this->userModel->errors()
        ]);
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        $data = $this->request->getJSON(true);
        $userId = $data['user_id'] ?? null;

        if (!$userId || !isset($data['current_password']) || !isset($data['new_password'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Missing required fields'
            ]);
        }

        $user = $this->userModel->find($userId);

        if (!password_verify($data['current_password'], $user['password'])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Current password is incorrect'
            ]);
        }

        if ($this->userModel->update($userId, ['password' => $data['new_password']])) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Password changed successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Password change failed'
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        // In production, invalidate JWT token
        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}
