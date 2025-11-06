<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionModel extends Model
{
    protected $table            = 'prescriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'patient_id',
        'doctor_id',
        'medical_record_id',
        'medicine_id',
        'dosage',
        'frequency',
        'duration',
        'quantity',
        'instructions',
        'status'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules      = [
        'patient_id'  => 'required|integer',
        'doctor_id'   => 'required|integer',
        'medicine_id' => 'required|integer',
        'dosage'      => 'required|min_length[2]',
        'frequency'   => 'required',
        'quantity'    => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    /**
     * Get prescriptions by patient
     */
    public function getPatientPrescriptions($patientId)
    {
        return $this->where('patient_id', $patientId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get active prescriptions
     */
    public function getActivePrescriptions()
    {
        return $this->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Update prescription status
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }
}
