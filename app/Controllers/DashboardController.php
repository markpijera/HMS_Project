<?php

namespace App\Controllers;

use App\Models\PatientModel;
use App\Models\DoctorModel;
use App\Models\AppointmentModel;
use App\Models\AdmissionModel;
use App\Models\MedicineModel;
use App\Models\InvoiceModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        $patientModel     = new PatientModel();
        $doctorModel      = new DoctorModel();
        $appointmentModel = new AppointmentModel();
        $admissionModel   = new AdmissionModel();
        $medicineModel    = new MedicineModel();
        $invoiceModel     = new InvoiceModel();

        $totalPatients     = $patientModel->countAll();
        $totalDoctors      = $doctorModel->countAll();
        $totalAppointments = $appointmentModel->countAll();
        $todayAppointments = $appointmentModel
            ->where('DATE(scheduled_at)', date('Y-m-d'))
            ->countAllResults();
        $activeAdmissions  = $admissionModel
            ->where('status', 'admitted')
            ->countAllResults();

        $lowStockList    = $medicineModel->getLowStockMedicines();
        $expiringList    = $medicineModel->getExpiringMedicines(30);
        $unpaidInvoiceList = $invoiceModel->getUnpaidInvoices();

        $lowStockMedicines   = is_array($lowStockList) ? count($lowStockList) : 0;
        $expiringMedicines   = is_array($expiringList) ? count($expiringList) : 0;
        $unpaidInvoices      = is_array($unpaidInvoiceList) ? count($unpaidInvoiceList) : 0;

        $recentAppointments = $appointmentModel
            ->where('scheduled_at >=', date('Y-m-d', strtotime('-7 days')))
            ->orderBy('scheduled_at', 'DESC')
            ->limit(5)
            ->find();

        $totalRevenueRow = $invoiceModel
            ->selectSum('total_amount')
            ->where('status', 'paid')
            ->first();
        $pendingAmountRow = $invoiceModel
            ->selectSum('total_amount')
            ->whereIn('status', ['unpaid', 'partially_paid'])
            ->first();

        $totalRevenue  = $totalRevenueRow['total_amount'] ?? 0;
        $pendingAmount = $pendingAmountRow['total_amount'] ?? 0;

        return view('dashboard/admin', [
            'user'                => $user,
            'stats'               => [
                'total_patients'      => $totalPatients,
                'total_doctors'       => $totalDoctors,
                'total_appointments'  => $totalAppointments,
                'today_appointments'  => $todayAppointments,
                'active_admissions'   => $activeAdmissions,
                'low_stock_medicines' => $lowStockMedicines,
                'expiring_medicines'  => $expiringMedicines,
                'unpaid_invoices'     => $unpaidInvoices,
                'total_revenue'       => $totalRevenue,
                'pending_amount'      => $pendingAmount,
            ],
            'recent_appointments' => $recentAppointments,
        ]);
    }
}
