<?php
$userName = $user['fullname'] ?? $user['name'] ?? session('user')['name'] ?? 'User';
$initials = strtoupper(substr($userName, 0, 1));
?>
<header class="topbar">
    <button id="sidebarToggle" class="topbar-btn d-lg-none" style="border:none;">
        <i class="bi bi-list" style="font-size:1.2rem;"></i>
    </button>
    <span class="topbar-title">Student Management System</span>
    <div class="topbar-actions">
        <a href="<?= base_url('profile') ?>" class="topbar-btn" title="Profile">
            <i class="bi bi-person"></i>
        </a>
        <a href="<?= base_url('logout') ?>" class="topbar-btn" title="Logout">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        <div class="dropdown">
            <a class="topbar-user dropdown-toggle" href="#" data-bs-toggle="dropdown" style="text-decoration:none;">
                <div class="avatar"><?= $initials ?></div>
                <span class="uname d-none d-md-inline"><?= esc($userName) ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="border-radius:12px; border:1px solid #e2e8f0; box-shadow:0 8px 30px rgba(0,0,0,0.12); min-width:200px; padding:8px;">
                <li class="px-3 py-2">
                    <div style="font-weight:600; font-size:.875rem; color:#1e293b;"><?= esc($userName) ?></div>
                    <div style="font-size:.75rem; color:#64748b;"><?= esc($user['email'] ?? session('user')['email'] ?? '') ?></div>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                <li><a class="dropdown-item" href="<?= base_url('profile') ?>" style="border-radius:8px; font-size:.875rem;"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li><hr class="dropdown-divider my-1"></li>
                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>" style="border-radius:8px; font-size:.875rem;"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</header>
