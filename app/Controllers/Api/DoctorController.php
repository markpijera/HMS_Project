<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DoctorModel;
use CodeIgniter\HTTP\ResponseInterface;

class DoctorController extends BaseController
{
    protected $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    /**
     * Get all doctors
     */
    public function index()
    {
        $specialization = $this->request->getGet('specialization');
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $builder = $this->doctorModel->builder();

        if ($specialization) {
            $builder->where('specialization', $specialization);
        }
        if ($status) {
            $builder->where('status', $status);
        }
        if ($search) {
            $builder->groupStart()
                    ->like('first_name', $search)
                    ->orLike('last_name', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->groupEnd();
        }

        $doctors = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $doctors
        ]);
    }

    /**
     * Get available doctors
     */
    public function available()
    {
        $doctors = $this->doctorModel->getAvailableDoctors();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $doctors
        ]);
    }

    /**
     * Get single doctor
     */
    public function show($id = null)
    {
        $doctor = $this->doctorModel->find($id);

        if (!$doctor) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Doctor not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $doctor
        ]);
    }

    /**
     * Create new doctor
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->doctorModel->insert($data)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status'  => 'success',
                'message' => 'Doctor created successfully',
                'data'    => $this->doctorModel->find($this->doctorModel->getInsertID())
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to create doctor',
            'errors'  => $this->doctorModel->errors()
        ]);
    }

    /**
     * Update doctor
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->doctorModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Doctor not found'
            ]);
        }

        if ($this->doctorModel->update($id, $data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Doctor updated successfully',
                'data'    => $this->doctorModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update doctor',
            'errors'  => $this->doctorModel->errors()
        ]);
    }

    /**
     * Delete doctor
     */
    public function delete($id = null)
    {
        if (!$this->doctorModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Doctor not found'
            ]);
        }

        if ($this->doctorModel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Doctor deleted successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to delete doctor'
        ]);
    }

    /**
     * Get doctor's schedule
     */
    public function schedule($id = null)
    {
        $doctor = $this->doctorModel->find($id);

        if (!$doctor) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Doctor not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => [
                'doctor_id'        => $doctor['doctor_id'],
                'name'             => $doctor['first_name'] . ' ' . $doctor['last_name'],
                'available_days'   => $doctor['available_days'],
                'available_hours'  => $doctor['available_hours'],
                'consultation_fee' => $doctor['consultation_fee']
            ]
        ]);
    }
}
