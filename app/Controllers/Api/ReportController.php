<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\AppointmentModel;
use App\Models\AdmissionModel;
use App\Models\InvoiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
{
    /**
     * Get patient report
     */
    public function patients()
    {
        $from = $this->request->getGet('from');
        $to = $this->request->getGet('to');
        
        $patientModel = new PatientModel();
        $builder = $patientModel->builder();
        
        if ($from && $to) {
            $builder->where('created_at >=', $from);
            $builder->where('created_at <=', $to);
        }
        
        $patients = $builder->get()->getResultArray();
        $totalCount = count($patients);
        
        // Group by gender
        $genderStats = [
            'Male' => 0,
            'Female' => 0,
            'Other' => 0
        ];
        
        foreach ($patients as $patient) {
            if (isset($patient['gender'])) {
                $genderStats[$patient['gender']]++;
            }
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total_patients' => $totalCount,
                'gender_distribution' => $genderStats,
                'patients' => $patients
            ]
        ]);
    }

    /**
     * Get appointment report
     */
    public function appointments()
    {
        $from = $this->request->getGet('from');
        $to = $this->request->getGet('to');
        
        $appointmentModel = new AppointmentModel();
        $builder = $appointmentModel->builder();
        
        if ($from && $to) {
            $builder->where('scheduled_at >=', $from);
            $builder->where('scheduled_at <=', $to);
        }
        
        $appointments = $builder->get()->getResultArray();
        
        // Group by status
        $statusStats = [
            'requested' => 0,
            'scheduled' => 0,
            'confirmed' => 0,
            'cancelled' => 0,
            'completed' => 0
        ];
        
        foreach ($appointments as $appointment) {
            if (isset($appointment['status'])) {
                $statusStats[$appointment['status']]++;
            }
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total_appointments' => count($appointments),
                'status_distribution' => $statusStats,
                'appointments' => $appointments
            ]
        ]);
    }

    /**
     * Get admission report
     */
    public function admissions()
    {
        $from = $this->request->getGet('from');
        $to = $this->request->getGet('to');
        
        $admissionModel = new AdmissionModel();
        $builder = $admissionModel->builder();
        
        if ($from && $to) {
            $builder->where('admission_date >=', $from);
            $builder->where('admission_date <=', $to);
        }
        
        $admissions = $builder->get()->getResultArray();
        
        // Calculate average stay duration for discharged patients
        $totalDuration = 0;
        $dischargedCount = 0;
        
        foreach ($admissions as $admission) {
            if ($admission['status'] === 'discharged' && $admission['discharge_date']) {
                $admitDate = strtotime($admission['admission_date']);
                $dischargeDate = strtotime($admission['discharge_date']);
                $duration = ($dischargeDate - $admitDate) / (60 * 60 * 24); // days
                $totalDuration += $duration;
                $dischargedCount++;
            }
        }
        
        $avgStayDuration = $dischargedCount > 0 ? round($totalDuration / $dischargedCount, 2) : 0;
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total_admissions' => count($admissions),
                'average_stay_days' => $avgStayDuration,
                'admissions' => $admissions
            ]
        ]);
    }

    /**
     * Get financial report
     */
    public function financial()
    {
        $from = $this->request->getGet('from');
        $to = $this->request->getGet('to');
        
        $invoiceModel = new InvoiceModel();
        $builder = $invoiceModel->builder();
        
        if ($from && $to) {
            $builder->where('created_at >=', $from);
            $builder->where('created_at <=', $to);
        }
        
        $invoices = $builder->get()->getResultArray();
        
        $totalRevenue = 0;
        $paidAmount = 0;
        $unpaidAmount = 0;
        
        foreach ($invoices as $invoice) {
            $totalRevenue += $invoice['total_amount'];
            
            if ($invoice['status'] === 'paid') {
                $paidAmount += $invoice['total_amount'];
            } else {
                $unpaidAmount += $invoice['total_amount'];
            }
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total_invoices' => count($invoices),
                'total_revenue' => $totalRevenue,
                'paid_amount' => $paidAmount,
                'unpaid_amount' => $unpaidAmount,
                'invoices' => $invoices
            ]
        ]);
    }
}
