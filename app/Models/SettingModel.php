<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'key',
        'value',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getValue(string $key, $default = '')
    {
        $row = $this->where('key', $key)->first();
        return $row['value'] ?? $default;
    }

    public function setValue(string $key, $value): bool
    {
        $row = $this->where('key', $key)->first();

        if ($row) {
            return (bool) $this->update($row['id'], [
                'value' => $value,
            ]);
        }

        return (bool) $this->insert([
            'key'   => $key,
            'value' => $value,
        ]);
    }
}
