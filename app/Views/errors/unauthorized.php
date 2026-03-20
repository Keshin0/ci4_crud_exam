<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>403 Unauthorized<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
    $role      = session('user')['role'] ?? null;
    $name      = session('user')['name'] ?? 'Guest';
    $dashboard = match($role) {
        'student' => '/student/dashboard',
        'admin', 'teacher' => '/dashboard',
        default => '/login',
    };
    $roleLabel = $role ? ucfirst($role) : 'Guest';
?>
<div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
    <div class="text-center" style="max-width: 480px;">

        <div class="mb-4">
            <span style="font-size: 6rem; line-height: 1;">🚫</span>
        </div>

        <h1 class="fw-bold text-danger mb-2" style="font-size: 4rem;">403</h1>
        <h4 class="fw-bold mb-3">Access Denied</h4>

        <?php if ($role): ?>
        <p class="text-muted mb-2">
            You are logged in as <strong><?= esc($name) ?></strong>
            with the role <span class="badge bg-secondary"><?= esc($roleLabel) ?></span>.
        </p>
        <?php endif; ?>
        <p class="text-muted mb-4">
            <?= $role
                ? 'Your current role does not have permission to access this page. Please contact an administrator if you believe this is a mistake.'
                : 'You must be logged in to access this page.'
            ?>
        </p>

        <a href="<?= base_url($dashboard) ?>" class="btn btn-primary px-4">
            <i data-feather="arrow-left" style="width:16px;height:16px;margin-right:6px;"></i>
            <?= $role ? 'Back to ' . esc($roleLabel) . ' Dashboard' : 'Go to Login' ?>
        </a>

    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>feather.replace();</script>
<?= $this->endSection() ?>
