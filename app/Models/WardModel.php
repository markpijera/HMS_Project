<?php

namespace App\Models;

use CodeIgniter\Model;

class WardModel extends Model
{
    protected $table            = 'wards';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'floor',
        'department',
        'total_beds',
        'available_beds',
        'ward_type',
        'status'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules      = [
        'name'        => 'required|min_length[3]|max_length[100]',
        'floor'       => 'required|integer',
        'total_beds'  => 'required|integer',
        'ward_type'   => 'required|in_list[general,private,icu,emergency]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    /**
     * Get available wards
     */
    public function getAvailableWards()
    {
        return $this->where('available_beds >', 0)
                    ->where('status', 'active')
                    ->findAll();
    }

    /**
     * Update bed availability
     */
    public function updateBedAvailability($wardId, $change)
    {
        $ward = $this->find($wardId);
        if (!$ward) {
            return false;
        }

        $newAvailable = $ward['available_beds'] + $change;
        
        // Ensure available beds doesn't exceed total or go below 0
        if ($newAvailable < 0 || $newAvailable > $ward['total_beds']) {
            return false;
        }

        return $this->update($wardId, ['available_beds' => $newAvailable]);
    }
}
