<?php

namespace App\Controllers;

use App\Models\RecordModel;
use CodeIgniter\HTTP\ResponseInterface;

class Records extends BaseController
{
    protected $recordModel;
    protected $pager;

    public function __construct()
    {
        $this->recordModel = model('RecordModel');
        $this->pager = \Config\Services::pager();
    }

    /**
     * Display list of all records with pagination
     * GET /records
     */
    public function index()
    {
        $perPage = 10;
        $records = $this->recordModel
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);

        $data = [
            'records' => $records,
            'pager'   => $this->recordModel->pager,
        ];

        return view('pages/records/index', $data);
    }

    /**
     * Show the form for creating a new record
     * GET /records/new
     */
    public function new()
    {
        if (session()->get('isLoggedIn')) {
            $data = [
                'validation' => \Config\Services::validation(),
            ];
            return view('pages/records/create', $data);
        }
        return redirect()->to('/login');
    }

    /**
     * Store a newly created record in database
     * POST /records
     */
    public function create()
    {
        // Validation rules
        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'status'      => 'required|in_list[active,inactive,pending]',
        ];

        // Validate input
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        // Prepare data
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'user_id'     => session()->get('user_id'),
        ];

        // Insert record
        if ($this->recordModel->insert($data)) {
            return redirect()->to('/records')
                ->with('success', 'Record created successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to create record. Please try again.');
        }
    }

    /**
     * Display the specified record (show detail view)
     * GET /records/:id
     */
    public function show($id = null)
    {
        $record = $this->recordModel->find($id);

        if (!$record) {
            return redirect()->to('/records')
                ->with('error', 'Record not found.');
        }

        $data = [
            'record' => $record,
        ];

        return view('pages/records/show', $data);
    }

    /**
     * Show the form for editing the specified record
     * GET /records/:id/edit
     */
    public function edit($id = null)
    {
        $record = $this->recordModel->find($id);

        if (!$record) {
            return redirect()->to('/records')
                ->with('error', 'Record not found.');
        }

        $data = [
            'record'     => $record,
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/records/edit', $data);
    }

    /**
     * Update the specified record in database
     * PUT/PATCH /records/:id
     */
    public function update($id = null)
    {
        // Check if record exists
        $record = $this->recordModel->find($id);
        if (!$record) {
            return redirect()->to('/records')
                ->with('error', 'Record not found.');
        }

        // Validation rules
        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'status'      => 'required|in_list[active,inactive,pending]',
        ];

        // Validate input
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        // Prepare data
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        // Update record
        if ($this->recordModel->update($id, $data)) {
            return redirect()->to('/records/' . $id)
                ->with('success', 'Record updated successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to update record. Please try again.');
        }
    }

    /**
     * Display records dashboard with statistics and recent records
     * GET /records/dashboard
     */
    public function dashboard()
    {
        // Get statistics
        $stats = [
            'total'    => $this->recordModel->countAllResults(),
            'active'   => $this->recordModel->where('status', 'active')->countAllResults(),
            'inactive' => $this->recordModel->where('status', 'inactive')->countAllResults(),
            'pending'  => $this->recordModel->where('status', 'pending')->countAllResults(),
        ];

        // Get recent records (last 5)
        $recentRecords = $this->recordModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'stats'          => $stats,
            'recentRecords'  => $recentRecords,
        ];

        return view('pages/records/dashboard', $data);
    }

    /**
     * Remove the specified record from database
     * Uses SOFT DELETE: Sets deleted_at timestamp instead of removing permanently
     * DELETE /records/:id
     */
    public function delete($id = null)
    {
        // Check if record exists
        $record = $this->recordModel->find($id);
        if (!$record) {
            return redirect()->to('/records')
                ->with('error', 'Record not found.');
        }

        // Perform soft delete using protected delete scope
        // This sets the deleted_at timestamp instead of removing the row
        if ($this->recordModel->delete($id)) {
            return redirect()->to('/records')
                ->with('success', 'Record deleted successfully!');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to delete record. Please try again.');
        }
    }
}
