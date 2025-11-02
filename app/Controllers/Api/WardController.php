<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\WardModel;
use CodeIgniter\HTTP\ResponseInterface;

class WardController extends BaseController
{
    protected $wardModel;

    public function __construct()
    {
        $this->wardModel = new WardModel();
    }

    /**
     * Get all wards
     */
    public function index()
    {
        $type = $this->request->getGet('type');
        $status = $this->request->getGet('status');

        $builder = $this->wardModel->builder();

        if ($type) {
            $builder->where('ward_type', $type);
        }
        if ($status) {
            $builder->where('status', $status);
        }

        $wards = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $wards
        ]);
    }

    /**
     * Get available wards
     */
    public function available()
    {
        $wards = $this->wardModel->getAvailableWards();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $wards
        ]);
    }

    /**
     * Get single ward
     */
    public function show($id = null)
    {
        $ward = $this->wardModel->find($id);

        if (!$ward) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Ward not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $ward
        ]);
    }

    /**
     * Create new ward
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        // Set available beds equal to total beds initially
        if (isset($data['total_beds']) && !isset($data['available_beds'])) {
            $data['available_beds'] = $data['total_beds'];
        }

        if ($this->wardModel->insert($data)) {
            return $this->response->setStatusCode(201)->setJSON([
                'status'  => 'success',
                'message' => 'Ward created successfully',
                'data'    => $this->wardModel->find($this->wardModel->getInsertID())
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to create ward',
            'errors'  => $this->wardModel->errors()
        ]);
    }

    /**
     * Update ward
     */
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->wardModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Ward not found'
            ]);
        }

        if ($this->wardModel->update($id, $data)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Ward updated successfully',
                'data'    => $this->wardModel->find($id)
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update ward',
            'errors'  => $this->wardModel->errors()
        ]);
    }

    /**
     * Delete ward
     */
    public function delete($id = null)
    {
        if (!$this->wardModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Ward not found'
            ]);
        }

        if ($this->wardModel->delete($id)) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Ward deleted successfully'
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to delete ward'
        ]);
    }
}
