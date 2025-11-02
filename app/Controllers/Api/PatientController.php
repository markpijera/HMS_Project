<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use CodeIgniter\HTTP\ResponseInterface;

class PatientController extends BaseController
{
    protected $patientModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();
    }

    /**
     * Get all patients with optional search
     */
    public function index()
    {
        $search = $this->request->getGet('search');
        
        if ($search) {
            $patients = $this->patientModel
                ->like('first_name', $search)
                ->orLike('last_name', $search)
                ->orLike('phone', $search)
                ->orLike('email', $search)
                ->findAll();
        } else {
            $patients = $this->patientModel->findAll();
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $patients
        ]);
    }

    /**
     * Get single patient
     */
    public function show($id = null)
    {
        $patient = $this->patientModel->find($id);

        if (!$patient) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Patient not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $patient
        ]);
    }

    /**
     * Create new patient
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->patientModel->insert($data)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status'  => 'success',
                'message' => 'Patient created successfully',
                'data'    => $this->patientModel->find($this->patientModel->getInsertID())
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to create patient',
            'errors'  => $this->patientModel->errors()
        ]);
    }

    /**
     * Update patient
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->patientModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Patient not found'
            ]);
        }

        if ($this->patientModel->update($id, $data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Patient updated successfully',
                'data'    => $this->patientModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update patient',
            'errors'  => $this->patientModel->errors()
        ]);
    }

    /**
     * Delete patient
     */
    public function delete($id = null)
    {
        if (!$this->patientModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Patient not found'
            ]);
        }

        if ($this->patientModel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Patient deleted successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to delete patient'
        ]);
    }
}
