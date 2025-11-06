<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PrescriptionModel;
use CodeIgniter\HTTP\ResponseInterface;

class PrescriptionController extends BaseController
{
    protected $prescriptionModel;

    public function __construct()
    {
        $this->prescriptionModel = new PrescriptionModel();
    }

    /**
     * Get all prescriptions
     */
    public function index()
    {
        $patientId = $this->request->getGet('patient_id');
        $doctorId = $this->request->getGet('doctor_id');
        $status = $this->request->getGet('status');

        $builder = $this->prescriptionModel->builder();

        if ($patientId) {
            $builder->where('patient_id', $patientId);
        }
        if ($doctorId) {
            $builder->where('doctor_id', $doctorId);
        }
        if ($status) {
            $builder->where('status', $status);
        }

        $prescriptions = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $prescriptions
        ]);
    }

    /**
     * Get active prescriptions
     */
    public function active()
    {
        $prescriptions = $this->prescriptionModel->getActivePrescriptions();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $prescriptions
        ]);
    }

    /**
     * Get patient's prescriptions
     */
    public function patientPrescriptions($patientId = null)
    {
        if (!$patientId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Patient ID is required'
            ]);
        }

        $prescriptions = $this->prescriptionModel->getPatientPrescriptions($patientId);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $prescriptions
        ]);
    }

    /**
     * Get single prescription
     */
    public function show($id = null)
    {
        $prescription = $this->prescriptionModel->find($id);

        if (!$prescription) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Prescription not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $prescription
        ]);
    }

    /**
     * Create new prescription
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->prescriptionModel->insert($data)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status'  => 'success',
                'message' => 'Prescription created successfully',
                'data'    => $this->prescriptionModel->find($this->prescriptionModel->getInsertID())
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to create prescription',
            'errors'  => $this->prescriptionModel->errors()
        ]);
    }

    /**
     * Update prescription
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->prescriptionModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Prescription not found'
            ]);
        }

        if ($this->prescriptionModel->update($id, $data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Prescription updated successfully',
                'data'    => $this->prescriptionModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update prescription',
            'errors'  => $this->prescriptionModel->errors()
        ]);
    }

    /**
     * Complete prescription
     */
    public function complete($id = null)
    {
        if (!$this->prescriptionModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Prescription not found'
            ]);
        }

        if ($this->prescriptionModel->updateStatus($id, 'completed')) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Prescription marked as completed',
                'data'    => $this->prescriptionModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update prescription status'
        ]);
    }

    /**
     * Cancel prescription
     */
    public function cancel($id = null)
    {
        if (!$this->prescriptionModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Prescription not found'
            ]);
        }

        if ($this->prescriptionModel->updateStatus($id, 'cancelled')) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Prescription cancelled',
                'data'    => $this->prescriptionModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to cancel prescription'
        ]);
    }

    /**
     * Delete prescription
     */
    public function delete($id = null)
    {
        if (!$this->prescriptionModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Prescription not found'
            ]);
        }

        if ($this->prescriptionModel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Prescription deleted successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to delete prescription'
        ]);
    }
}
