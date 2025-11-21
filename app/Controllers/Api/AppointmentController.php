<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use CodeIgniter\HTTP\ResponseInterface;

class AppointmentController extends BaseController
{
    protected $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
    }

    /**
     * Get all appointments with filters
     */
    public function index()
    {
        $doctorId = $this->request->getGet('doctor_id');
        $patientId = $this->request->getGet('patient_id');
        $date = $this->request->getGet('date');
        $status = $this->request->getGet('status');

        $builder = $this->appointmentModel->builder();

        if ($doctorId) {
            $builder->where('doctor_id', $doctorId);
        }
        if ($patientId) {
            $builder->where('patient_id', $patientId);
        }
        if ($date) {
            $builder->where('DATE(scheduled_at)', $date);
        }
        if ($status) {
            $builder->where('status', $status);
        }

        $appointments = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $appointments
        ]);
    }

    /**
     * Create new appointment
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        // Set default duration if not provided
        if (!isset($data['duration_minutes'])) {
            $data['duration_minutes'] = 30;
        }

        // Set default status
        if (!isset($data['status'])) {
            $data['status'] = 'requested';
        }

        if ($this->appointmentModel->insert($data)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status'  => 'success',
                'message' => 'Appointment created successfully',
                'data'    => $this->appointmentModel->find($this->appointmentModel->getInsertID())
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to create appointment',
            'errors'  => $this->appointmentModel->errors()
        ]);
    }

    /**
     * Update appointment
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->appointmentModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Appointment not found'
            ]);
        }

        if ($this->appointmentModel->update($id, $data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Appointment updated successfully',
                'data'    => $this->appointmentModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update appointment',
            'errors'  => $this->appointmentModel->errors()
        ]);
    }

    /**
     * Confirm appointment
     */
    public function confirm($id = null)
    {
        if (!$this->appointmentModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Appointment not found'
            ]);
        }

        if ($this->appointmentModel->update($id, ['status' => 'confirmed'])) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Appointment confirmed successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to confirm appointment'
        ]);
    }

    /**
     * Cancel appointment
     */
    public function cancel($id = null)
    {
        if (!$this->appointmentModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Appointment not found'
            ]);
        }

        if ($this->appointmentModel->update($id, ['status' => 'cancelled'])) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Appointment cancelled successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to cancel appointment'
        ]);
    }

    /**
     * Delete appointment
     */
    public function delete($id = null)
    {
        if (!$this->appointmentModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Appointment not found'
            ]);
        }

        if ($this->appointmentModel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Appointment deleted successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to delete appointment'
        ]);
    }
}
