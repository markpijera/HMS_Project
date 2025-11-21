<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $currentUser = session()->get('user');

        if (! $currentUser || ($currentUser['role'] ?? null) !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $users = $this->userModel
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('users/index', [
            'users' => $users,
        ]);
    }

    public function resetPassword($id = null)
    {
        $currentUser = session()->get('user');

        if (! $currentUser || ($currentUser['role'] ?? null) !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        return view('users/reset_password', [
            'user' => $user,
        ]);
    }

    public function updatePassword($id = null)
    {
        $currentUser = session()->get('user');

        if (! $currentUser || ($currentUser['role'] ?? null) !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $user = $this->userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found');
        }

        $newPassword        = $this->request->getPost('new_password');
        $newPasswordConfirm = $this->request->getPost('new_password_confirm');

        $errors = [];

        if (! $newPassword || strlen($newPassword) < 8) {
            $errors[] = 'Password must be at least 8 characters.';
        }

        if ($newPassword !== $newPasswordConfirm) {
            $errors[] = 'Password confirmation does not match.';
        }

        if (! empty($errors)) {
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        if (! $this->userModel->update($id, ['password' => $newPassword])) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/users')->with('message', 'Password updated successfully for ' . ($user['email'] ?? 'user')); 
    }
}
