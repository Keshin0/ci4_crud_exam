<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = model('UserModel');
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            $role = session('user')['role'] ?? '';
            return match($role) {
                'student' => redirect()->to('/student/dashboard'),
                default   => redirect()->to('/dashboard'),
            };
        }

        return view('pages/commons/login');
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            $role = session('user')['role'] ?? '';
            return match($role) {
                'student' => redirect()->to('/student/dashboard'),
                default   => redirect()->to('/dashboard'),
            };
        }

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('pages/commons/login', ['validation' => $this->validator]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $found = $this->userModel
            ->select('users.id, users.name, users.email, users.password, users.role_id, roles.name AS role_name')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->where('users.email', $email)
            ->first();

        if ($found && password_verify($password, $found['password'])) {
            $role = $found['role_name'] ?? '';
            session()->set([
                'isLoggedIn' => true,
                'user' => [
                    'id'      => $found['id'],
                    'name'    => $found['name'],
                    'email'   => $found['email'],
                    'role'    => $role,
                    'role_id' => $found['role_id'],
                ],
            ]);
            return match($role) {
                'admin'   => redirect()->to('/dashboard'),
                'teacher' => redirect()->to('/dashboard'),
                'student' => redirect()->to('/student/dashboard'),
                default   => redirect()->to('/login'),
            };
        } else {
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->back()->withInput();
        }
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            $role = session('user')['role'] ?? '';
            return match($role) {
                'student' => redirect()->to('/student/dashboard'),
                default   => redirect()->to('/dashboard'),
            };
        }

        return view('pages/commons/register');
    }

    public function storeRegister()
    {
        $rules = [
            'name'             => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('pages/commons/register', ['validation' => $this->validator]);
        }

        $roleModel = model('RoleModel');
        $role      = $roleModel->findByName('student');

        $data = [
            'name'     => $this->request->getPost('name'),
            'fullname' => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role_id'  => $role['id'] ?? null,
        ];

        if ($this->userModel->insert($data)) {
            session()->setFlashdata('success', 'Registration successful. Please login.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    /**
     * Display forbidden/blocked page
     * Shown when user doesn't have permission to access a resource
     */
    public function forbiddenPage()
    {
        return view('pages/commons/forbidden');
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }
}
