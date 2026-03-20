<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RecordModel;
use App\Models\StudentModel;

class Home extends BaseController
{
    public function index(): string
    {
        $userModel    = new UserModel();
        $recordModel  = new RecordModel();
        $studentModel = new StudentModel();

        $totalStudents = $userModel->db->table('users u')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('r.name', 'student')
            ->countAllResults();

        $data = array_merge($this->data, [
            'title'         => 'Dashboard',
            'totalStudents' => $totalStudents,
            'totalRecords'  => $recordModel->countAll(),
            'totalUsers'    => $userModel->countAll(),
        ]);
        return view('pages/commons/dashboard', $data);
    }

    public function dashboardV2(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Dashboard v2 Page'
        ]);
        return view('pages/commons/dashboard_v2', $data);
    }

    public function dashboardV3(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Dashboard v3 Page'
        ]);
        return view('pages/commons/dashboard_v3', $data);
    }
}
