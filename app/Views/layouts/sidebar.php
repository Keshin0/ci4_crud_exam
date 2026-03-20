<?php
$seg = $segment ?? '';
$role = $user['role'] ?? session('user')['role'] ?? '';
$userName = $user['fullname'] ?? $user['name'] ?? session('user')['name'] ?? 'User';
$initials = strtoupper(substr($userName, 0, 1));
?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <div class="brand-text">
            <div>Student MS</div>
            <div class="brand-sub">Management System</div>
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Main</div>
        <a href="<?= base_url('dashboard') ?>" class="nav-item-link <?= $seg === 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="<?= base_url('students') ?>" class="nav-item-link <?= $seg === 'students' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Students
        </a>
        <a href="<?= base_url('records') ?>" class="nav-item-link <?= $seg === 'records' ? 'active' : '' ?>">
            <i class="bi bi-journal-text"></i> Records
        </a>
    </div>

    <?php if ($role === 'admin'): ?>
    <div class="sidebar-section">
        <div class="sidebar-section-label">Admin</div>
        <a href="<?= base_url('admin/users') ?>" class="nav-item-link <?= $seg === 'admin' ? 'active' : '' ?>">
            <i class="bi bi-person-gear"></i> User Management
        </a>
        <a href="<?= base_url('admin/roles') ?>" class="nav-item-link">
            <i class="bi bi-shield-check"></i> Roles
        </a>
        <a href="<?= base_url('admin/menu-management') ?>" class="nav-item-link">
            <i class="bi bi-list-nested"></i> Menu Management
        </a>
    </div>
    <?php endif; ?>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Account</div>
        <a href="<?= base_url('profile') ?>" class="nav-item-link <?= $seg === 'profile' ? 'active' : '' ?>">
            <i class="bi bi-person-circle"></i> Profile
        </a>
        <a href="<?= base_url('logout') ?>" class="nav-item-link">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="avatar"><?= $initials ?></div>
            <div class="user-info">
                <div class="name"><?= esc($userName) ?></div>
                <div class="role"><?= esc(ucfirst($role)) ?></div>
            </div>
        </div>
    </div>
</aside>
