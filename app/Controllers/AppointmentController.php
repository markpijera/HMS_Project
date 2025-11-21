<?php

namespace App\Controllers;

use App\Models\AppointmentModel;
use App\Models\PatientModel;
use App\Models\DoctorModel;

class AppointmentController extends BaseController
{
    protected AppointmentModel $appointmentModel;
    protected PatientModel $patientModel;
    protected DoctorModel $doctorModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->patientModel     = new PatientModel();
        $this->doctorModel      = new DoctorModel();
    }

    public function index()
    {
        $date   = $this->request->getGet('date');
        $status = $this->request->getGet('status');

        $builder = $this->appointmentModel->builder();
        $builder->select('appointments.*, patients.first_name AS patient_first_name, patients.last_name AS patient_last_name, doctors.first_name AS doctor_first_name, doctors.last_name AS doctor_last_name');
        $builder->join('patients', 'patients.patient_id = appointments.patient_id', 'left');
        $builder->join('doctors', 'doctors.doctor_id = appointments.doctor_id', 'left');

        if ($date) {
            $builder->where('DATE(appointments.scheduled_at)', $date);
        }

        if ($status) {
            $builder->where('appointments.status', $status);
        }

        $appointments = $builder->orderBy('appointments.scheduled_at', 'DESC')->get()->getResultArray();

        return view('appointments/index', [
            'appointments' => $appointments,
            'filter_date'  => $date,
            'filter_status'=> $status,
        ]);
    }

    public function show($id = null)
    {
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Appointment not found');
        }

        $builder = $this->appointmentModel->builder();
        $builder->select('appointments.*, '
            . 'patients.first_name AS patient_first_name, patients.last_name AS patient_last_name, '
            . 'doctors.first_name AS doctor_first_name, doctors.last_name AS doctor_last_name');
        $builder->join('patients', 'patients.patient_id = appointments.patient_id', 'left');
        $builder->join('doctors', 'doctors.doctor_id = appointments.doctor_id', 'left');
        $builder->where('appointments.id', $id);

        $appointment = $builder->get()->getRowArray();

        if (! $appointment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Appointment not found');
        }

        return view('appointments/show', [
            'appointment' => $appointment,
        ]);
    }

    public function new()
    {
        $patients = $this->patientModel->orderBy('first_name')->findAll();
        $doctors  = $this->doctorModel->orderBy('first_name')->findAll();

        return view('appointments/new', [
            'patients' => $patients,
            'doctors'  => $doctors,
        ]);
    }

    public function create()
    {
        $data = $this->request->getPost();

        if (! empty($data['scheduled_at'])) {
            $data['scheduled_at'] = date('Y-m-d H:i:s', strtotime($data['scheduled_at']));
        }

        if (! isset($data['duration_minutes']) || $data['duration_minutes'] === '') {
            $data['duration_minutes'] = 30;
        }

        if (! isset($data['status']) || $data['status'] === '') {
            $data['status'] = 'requested';
        }

        if (! $this->appointmentModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->appointmentModel->errors());
        }

        return redirect()->to('/appointments');
    }

    public function confirm($id = null)
    {
        $this->appointmentModel->update($id, ['status' => 'confirmed']);

        return redirect()->to('/appointments');
    }

    public function cancel($id = null)
    {
        $this->appointmentModel->update($id, ['status' => 'cancelled']);

        return redirect()->to('/appointments');
    }

    public function delete($id = null)
    {
        $this->appointmentModel->delete($id);

        return redirect()->to('/appointments');
    }
}
