<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table            = 'patients';
    protected $primaryKey       = 'patient_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'blood_type',
        'phone',
        'email',
        'address',
        'emergency_contact',
        'emergency_phone',
        'medical_history',
        'allergies',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'first_name'     => 'required|min_length[2]|max_length[50]',
        'last_name'      => 'required|min_length[2]|max_length[50]',
        'date_of_birth'  => 'required|valid_date',
        'gender'         => 'required|in_list[Male,Female,Other]',
        'phone'          => 'required|min_length[10]|max_length[15]',
        'email'          => 'permit_empty|valid_email',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
