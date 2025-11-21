<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Admin-only: update another user's password
     */
    public function adminUpdatePassword()
    {
        $data = $this->request->getJSON(true);

        $adminId     = $data['admin_id']     ?? null;
        $userId      = $data['user_id']      ?? null;
        $newPassword = $data['new_password'] ?? null;

        if (! $adminId || ! $userId || ! $newPassword) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)->setJSON([
                'status'  => 'error',
                'message' => 'admin_id, user_id and new_password are required',
            ]);
        }

        $admin = $this->userModel->find($adminId);

        if (! $admin || ($admin['role'] ?? null) !== 'admin' || ($admin['status'] ?? 'active') !== 'active') {
            return $this->response->setStatusCode(ResponseInterface::HTTP_FORBIDDEN)->setJSON([
                'status'  => 'error',
                'message' => 'Only active admin users can update passwords',
            ]);
        }

        $user = $this->userModel->find($userId);

        if (! $user) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON([
                'status'  => 'error',
                'message' => 'User not found',
            ]);
        }

        if ($this->userModel->update($userId, ['password' => $newPassword])) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Password updated successfully',
            ]);
        }

        return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update password',
            'errors'  => $this->userModel->errors(),
        ]);
    }
}
