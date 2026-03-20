<?php

namespace App\Controllers;

use App\Models\UserModel;

class StudentDashboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->findWithRole((int) session('user')['id']);

        $data = array_merge($this->data, [
            'title' => 'Student Dashboard',
            'user'  => $user,
        ]);

        return view('student/dashboard', $data);
    }
}
