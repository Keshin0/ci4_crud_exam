<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$role     = session('user')['role'] ?? $user['role'] ?? '';
$name     = session('user')['name'] ?? $user['name'] ?? 'User';
$hour     = (int) date('H');
$greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
?>

<!-- Page Header -->
<div class="page-header">
    <h1><?= $greeting ?>, <?= esc($name) ?> 👋</h1>
    <p>Here's what's happening in your system today.</p>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;border-radius:14px;background:#e8f1fa;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-people-fill" style="font-size:1.4rem;color:#2d6a9f;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;"><?= $totalStudents ?? 0 ?></div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:3px;">Total Students</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;border-radius:14px;background:#d1fae5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-journal-text" style="font-size:1.4rem;color:#059669;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;"><?= $totalRecords ?? 0 ?></div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:3px;">Total Records</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;border-radius:14px;background:#fef3c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-person-badge" style="font-size:1.4rem;color:#d97706;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;"><?= $totalUsers ?? 0 ?></div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:3px;">Total Users</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;border-radius:14px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-shield-check" style="font-size:1.4rem;color:#dc2626;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#1e293b;line-height:1;"><?= esc(ucfirst($role)) ?></div>
                    <div style="font-size:.8rem;color:#64748b;margin-top:3px;">Your Role</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions + Info -->
<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-lightning-charge me-2" style="color:#2d6a9f;"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <?php if ($role === 'admin'): ?>
                    <div class="col-md-6">
                        <a href="<?= site_url('admin/users') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#e8f1fa;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-person-gear" style="color:#2d6a9f;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">User Management</div>
                                <div style="font-size:.775rem;color:#64748b;">Assign roles to users</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= site_url('admin/roles') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#d1fae5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-shield-check" style="color:#059669;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">Role Management</div>
                                <div style="font-size:.775rem;color:#64748b;">Create and manage roles</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= site_url('students') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#fef3c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-people" style="color:#d97706;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">Student List</div>
                                <div style="font-size:.775rem;color:#64748b;">View all registered students</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= site_url('admin/menu-management') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-list-nested" style="color:#dc2626;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">Menu Management</div>
                                <div style="font-size:.775rem;color:#64748b;">Configure navigation menus</div>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="col-md-6">
                        <a href="<?= base_url('students') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#e8f1fa;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-people" style="color:#2d6a9f;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">Students</div>
                                <div style="font-size:.775rem;color:#64748b;">View and manage students</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('records') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#d1fae5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-journal-text" style="color:#059669;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">Records</div>
                                <div style="font-size:.775rem;color:#64748b;">Manage all records</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('computers') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#fef3c7;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-pc-display" style="color:#d97706;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">Computers</div>
                                <div style="font-size:.775rem;color:#64748b;">Manage computer inventory</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('profile') ?>" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="border-radius:12px;border:1.5px solid #e2e8f0;transition:all .2s;" onmouseover="this.style.borderColor='#2d6a9f';this.style.background='#f0f7ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff'">
                            <div style="width:42px;height:42px;border-radius:10px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-person-circle" style="color:#dc2626;font-size:1.1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:.875rem;color:#1e293b;">My Profile</div>
                                <div style="font-size:.775rem;color:#64748b;">Update your information</div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h5><i class="bi bi-info-circle me-2" style="color:#2d6a9f;"></i>System Info</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush" style="border-radius:0 0 14px 14px;">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3" style="border-color:#f1f5f9;">
                        <span style="font-size:.875rem;color:#64748b;">Logged in as</span>
                        <span class="badge" style="background:#e8f1fa;color:#2d6a9f;border-radius:6px;"><?= esc(ucfirst($role)) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3" style="border-color:#f1f5f9;">
                        <span style="font-size:.875rem;color:#64748b;">Date</span>
                        <span style="font-size:.875rem;font-weight:500;"><?= date('M d, Y') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3" style="border-color:#f1f5f9;">
                        <span style="font-size:.875rem;color:#64748b;">Time</span>
                        <span style="font-size:.875rem;font-weight:500;" id="live-time"><?= date('h:i A') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3" style="border-color:#f1f5f9;">
                        <span style="font-size:.875rem;color:#64748b;">Environment</span>
                        <span class="badge" style="background:#d1fae5;color:#059669;border-radius:6px;"><?= ucfirst(ENVIRONMENT) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3" style="border-color:#f1f5f9;">
                        <span style="font-size:.875rem;color:#64748b;">PHP Version</span>
                        <span style="font-size:.875rem;font-weight:500;"><?= PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    setInterval(() => {
        const now = new Date();
        let h = now.getHours(), m = now.getMinutes(), ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        document.getElementById('live-time').textContent = `${h}:${String(m).padStart(2,'0')} ${ampm}`;
    }, 1000);
</script>
<?= $this->endSection() ?>
