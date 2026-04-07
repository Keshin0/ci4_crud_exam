<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class StudentsController extends BaseApiController
{
    private UserModel $userModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can list students.');
        }

        return $this->ok(array_map([$this, 'sanitize'], $this->userModel->getStudents()));
    }

    public function show(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can view student profiles.');
        }

        $student = $this->userModel->getStudentById($id);

        return $student
            ? $this->ok($this->sanitize($student))
            : $this->notFound("Student #{$id} not found.");
    }

    private function hasTeacherAccess(): bool
    {
        return $this->apiUser && in_array($this->apiUser['role_name'], ['teacher', 'admin'], true);
    }

    private function sanitize(array $row): array
    {
        unset($row['password'], $row['deleted_at']);
        return $row;
    }
}
