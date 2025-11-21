<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\AppointmentModel;
use App\Models\AdmissionModel;
use App\Models\MedicineModel;
use App\Models\InvoiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    /**
     * Get dashboard statistics
     */
    public function index()
    {
        $patientModel = new PatientModel();
        $doctorModel = new DoctorModel();
        $appointmentModel = new AppointmentModel();
        $admissionModel = new AdmissionModel();
        $medicineModel = new MedicineModel();
        $invoiceModel = new InvoiceModel();

        // Get counts
        $totalPatients = $patientModel->countAll();
        $totalDoctors = $doctorModel->countAll();
        $totalAppointments = $appointmentModel->countAll();
        
        // Get today's appointments
        $todayAppointments = $appointmentModel->where('DATE(scheduled_at)', date('Y-m-d'))->countAllResults();
        
        // Get active admissions
        $activeAdmissions = $admissionModel->where('status', 'admitted')->countAllResults();
        
        // Get low stock medicines
        $lowStockMedicines = count($medicineModel->getLowStockMedicines());
        
        // Get expiring medicines (next 30 days)
        $expiringMedicines = count($medicineModel->getExpiringMedicines(30));
        
        // Get unpaid invoices
        $unpaidInvoices = count($invoiceModel->getUnpaidInvoices());
        
        // Get recent appointments (last 7 days)
        $recentAppointments = $appointmentModel
            ->where('scheduled_at >=', date('Y-m-d', strtotime('-7 days')))
            ->orderBy('scheduled_at', 'DESC')
            ->limit(10)
            ->find();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'statistics' => [
                    'total_patients' => $totalPatients,
                    'total_doctors' => $totalDoctors,
                    'total_appointments' => $totalAppointments,
                    'today_appointments' => $todayAppointments,
                    'active_admissions' => $activeAdmissions,
                    'low_stock_medicines' => $lowStockMedicines,
                    'expiring_medicines' => $expiringMedicines,
                    'unpaid_invoices' => $unpaidInvoices,
                ],
                'recent_appointments' => $recentAppointments,
            ]
        ]);
    }

    /**
     * Get appointment statistics by status
     */
    public function appointmentStats()
    {
        $appointmentModel = new AppointmentModel();
        
        $stats = [
            'requested' => $appointmentModel->where('status', 'requested')->countAllResults(false),
            'scheduled' => $appointmentModel->where('status', 'scheduled')->countAllResults(false),
            'confirmed' => $appointmentModel->where('status', 'confirmed')->countAllResults(false),
            'cancelled' => $appointmentModel->where('status', 'cancelled')->countAllResults(false),
            'completed' => $appointmentModel->where('status', 'completed')->countAllResults(false),
        ];

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $stats
        ]);
    }

    /**
     * Get admission statistics
     */
    public function admissionStats()
    {
        $admissionModel = new AdmissionModel();
        
        $stats = [
            'admitted' => $admissionModel->where('status', 'admitted')->countAllResults(false),
            'discharged' => $admissionModel->where('status', 'discharged')->countAllResults(false),
            'transferred' => $admissionModel->where('status', 'transferred')->countAllResults(false),
        ];

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $stats
        ]);
    }

    /**
     * Get financial overview
     */
    public function financialOverview()
    {
        $invoiceModel = new InvoiceModel();
        
        $totalRevenue = $invoiceModel->selectSum('total_amount')->where('status', 'paid')->first();
        $pendingAmount = $invoiceModel->selectSum('total_amount')->whereIn('status', ['unpaid', 'partially_paid'])->first();
        
        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total_revenue' => $totalRevenue['total_amount'] ?? 0,
                'pending_amount' => $pendingAmount['total_amount'] ?? 0,
            ]
        ]);
    }
}
