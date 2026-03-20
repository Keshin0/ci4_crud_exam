<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>My Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$name    = $user['fullname'] ?? $user['name'] ?? 'User';
$initial = strtoupper(substr($name, 0, 1));
$role    = session('user')['role'] ?? '';
$editUrl = $role === 'student' ? base_url('student/profile/edit') : base_url('profile/edit');
?>

<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>My Profile</h1>
        <p>View and manage your personal information</p>
    </div>
    <a href="<?= $editUrl ?>" class="btn btn-primary">
        <i class="bi bi-pencil me-1"></i> Edit Profile
    </a>
</div>

<div class="row g-3">
    <!-- Avatar Card -->
    <div class="col-lg-3">
        <div class="card text-center">
            <div class="card-body py-4">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         class="rounded-circle mb-3"
                         style="width:100px;height:100px;object-fit:cover;border:4px solid #e8f1fa;" alt="Avatar">
                <?php else: ?>
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width:100px;height:100px;background:linear-gradient(135deg,#1e3a5f,#2d6a9f);font-size:2.5rem;font-weight:700;color:#fff;">
                        <?= $initial ?>
                    </div>
                <?php endif; ?>
                <h5 class="fw-700 mb-1" style="font-weight:700;"><?= esc($name) ?></h5>
                <p class="text-muted mb-2" style="font-size:.85rem;"><?= esc($user['email'] ?? '') ?></p>
                <span class="badge" style="background:#e8f1fa;color:#2d6a9f;border-radius:6px;font-weight:500;">
                    <?= esc(ucfirst($role)) ?>
                </span>
            </div>
        </div>

        <!-- Member Since -->
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-calendar-check" style="color:#2d6a9f;"></i>
                    <span style="font-size:.75rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;">Member Since</span>
                </div>
                <p class="mb-0 fw-600" style="font-weight:600;font-size:.9rem;">
                    <?= !empty($user['created_at']) ? date('F d, Y', strtotime($user['created_at'])) : 'N/A' ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="col-lg-9">
        <!-- Basic Info -->
        <div class="card mb-3">
            <div class="card-header">
                <h5><i class="bi bi-person me-2" style="color:#2d6a9f;"></i>Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Full Name</p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($name) ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Email Address</p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($user['email'] ?? 'Not set') ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Phone Number</p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($user['phone'] ?? 'Not set') ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Address</p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($user['address'] ?? 'Not set') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role-based Info -->
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-person-badge me-2" style="color:#2d6a9f;"></i><?= $role === 'admin' ? 'Admin Information' : 'Teacher Information' ?></h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;"><?= $role === 'admin' ? 'Admin ID' : 'Employee ID' ?></p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($user['student_id'] ?? 'Not set') ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;"><?= $role === 'admin' ? 'Office / Unit' : 'Department' ?></p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($user['course'] ?? 'Not set') ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;"><?= $role === 'admin' ? 'Year Level Access' : 'Year Level Handled' ?></p>
                        <p class="mb-0 fw-600" style="font-weight:600;">
                            <?= !empty($user['year_level']) ? 'Year ' . esc($user['year_level']) : 'Not set' ?>
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-muted mb-1" style="font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;"><?= $role === 'admin' ? 'Section Access' : 'Section Handled' ?></p>
                        <p class="mb-0 fw-600" style="font-weight:600;"><?= esc($user['section'] ?? 'Not set') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
