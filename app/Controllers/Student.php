<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Student extends BaseController
{
    public function index()
    {
        $model = new StudentModel();
        $data = array_merge($this->data, [
            'students' => $model->findAll()
        ]);
        return view('pages/student_view', $data);
    }

    public function store()
    {
        $model = new StudentModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
        $model->insert($data);
        return redirect()->to('/students');
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            return redirect()->to('/students');
        }
        $data = array_merge($this->data, ['student' => $student]);
        return view('pages/students/edit', $data);
    }

    public function update($id)
    {
        $model = new StudentModel();
        $data = [
            'name'   => $this->request->getPost('name'),
            'email'  => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];
        $model->update($id, $data);
        return redirect()->to('/students');
    }

    public function delete($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->to('/students');
    }
}
