<?php

namespace App\Controllers;

use App\Models\SettingModel;

class SettingsController extends BaseController
{
    protected SettingModel $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        if ($redirect = $this->enforceRoles(['admin'])) {
            return $redirect;
        }

        $keys = [
            'hospital_name',
            'hospital_email',
            'hospital_phone',
            'hospital_address',
            'hospital_website',
        ];

        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = $this->settingModel->getValue($key, '');
        }

        return view('settings/index', [
            'settings' => $settings,
        ]);
    }

    public function update()
    {
        if ($redirect = $this->enforceRoles(['admin'])) {
            return $redirect;
        }

        $keys = [
            'hospital_name',
            'hospital_email',
            'hospital_phone',
            'hospital_address',
            'hospital_website',
        ];

        foreach ($keys as $key) {
            $value = $this->request->getPost($key) ?? '';
            $this->settingModel->setValue($key, $value);
        }

        return redirect()->to('/settings')->with('message', 'Settings updated successfully.');
    }
}
