<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function show()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'User not found. Please login again.');
        }

        return view('profile/show', ['user' => $user]);
    }

    public function edit()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'User not found. Please login again.');
        }

        return view('profile/edit', ['user' => $user]);
    }

    public function update()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'User not found. Please login again.');
        }

        // Server-side validation
        $rules = [
            'fullname' => 'required|min_length[3]|max_length[255]',
            'email' => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'student_id' => 'permit_empty|max_length[20]',
            'course' => 'permit_empty|max_length[100]',
            'year_level' => 'permit_empty|integer|in_list[1,2,3,4,5]',
            'section' => 'permit_empty|max_length[50]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Build update data
        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        // Handle image upload
        $file = $this->request->getFile('profile_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate image
            $imageRules = [
                'profile_image' => 'is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]'
            ];

            if (!$this->validate($imageRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Delete old image if exists
            if (!empty($user['profile_image'])) {
                $oldImagePath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Generate unique filename
            $ext = $file->getExtension();
            $newFilename = 'avatar_' . $userId . '_' . time() . '.' . $ext;

            // Move file to uploads/profiles/
            $file->move(FCPATH . 'uploads/profiles/', $newFilename);

            // Add filename to update data
            $updateData['profile_image'] = $newFilename;
        }

        // Update profile
        if ($this->userModel->updateProfile($userId, $updateData)) {
            // Update session
            $updatedUser = $this->userModel->find($userId);
            session()->set('user_id', $updatedUser['id']);
            session()->set('name', $updatedUser['name'] ?? $updatedUser['fullname']);
            session()->set('email', $updatedUser['email']);

            return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update profile. Please try again.');
    }
}
