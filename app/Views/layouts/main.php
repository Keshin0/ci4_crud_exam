<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #2d6a9f;
            --topbar-height: 64px;
            --accent: #2d6a9f;
            --accent-light: #e8f1fa;
            --body-bg: #f1f5f9;
            --card-radius: 14px;
            --text-primary: #1e293b;
            --text-muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--body-bg); color: var(--text-primary); }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 20px 24px;
            display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            min-height: var(--topbar-height);
        }
        .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent), #1a8a6e);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff; flex-shrink: 0;
        }
        .sidebar-brand .brand-text { color: #fff; font-weight: 700; font-size: 0.95rem; line-height: 1.2; }
        .sidebar-brand .brand-sub { color: rgba(255,255,255,0.4); font-size: 0.72rem; font-weight: 400; }

        .sidebar-section { padding: 20px 16px 8px; }
        .sidebar-section-label {
            color: rgba(255,255,255,0.3);
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0 8px;
            margin-bottom: 6px;
        }
        .nav-item-link {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .nav-item-link i { font-size: 1rem; flex-shrink: 0; }
        .nav-item-link:hover { background: var(--sidebar-hover); color: #fff; }
        .nav-item-link.active { background: var(--sidebar-active); color: #fff; box-shadow: 0 4px 12px rgba(45,106,159,0.4); }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
        }
        .sidebar-user .avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), #1a8a6e);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 600; font-size: 0.85rem; flex-shrink: 0;
        }
        .sidebar-user .user-info .name { color: #fff; font-size: 0.825rem; font-weight: 600; }
        .sidebar-user .user-info .role { color: rgba(255,255,255,0.4); font-size: 0.72rem; }

        /* ── Topbar ── */
        .topbar {
            position: fixed; top: 0;
            left: var(--sidebar-width); right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center;
            padding: 0 28px;
            z-index: 999;
            gap: 16px;
        }
        .topbar-title { font-weight: 600; font-size: 1rem; color: var(--text-primary); flex: 1; }
        .topbar-actions { display: flex; align-items: center; gap: 8px; }
        .topbar-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            cursor: pointer; transition: all 0.2s;
            text-decoration: none;
        }
        .topbar-btn:hover { background: var(--accent-light); border-color: var(--accent); color: var(--accent); }
        .topbar-user {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px 6px 6px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none; color: inherit;
        }
        .topbar-user:hover { background: var(--accent-light); border-color: var(--accent); }
        .topbar-user .avatar {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, var(--accent), #1a8a6e);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 600; font-size: 0.75rem;
        }
        .topbar-user .uname { font-size: 0.825rem; font-weight: 600; color: var(--text-primary); }

        /* ── Main Content ── */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }
        .page-body { padding: 28px; }

        /* ── Cards ── */
        .card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            border-radius: var(--card-radius) var(--card-radius) 0 0 !important;
            padding: 18px 24px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h5 { font-weight: 600; font-size: 0.95rem; margin: 0; color: var(--text-primary); }
        .card-body { padding: 24px; }

        /* ── Buttons ── */
        .btn { border-radius: 9px; font-weight: 500; font-size: 0.875rem; padding: 8px 16px; transition: all 0.2s; }
        .btn-primary { background: linear-gradient(135deg, #1e3a5f, var(--accent)); border: none; box-shadow: 0 3px 10px rgba(45,106,159,0.3); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 5px 15px rgba(45,106,159,0.4); }
        .btn-warning { background: #f59e0b; border: none; color: #fff; }
        .btn-warning:hover { background: #d97706; color: #fff; }
        .btn-danger { background: #ef4444; border: none; }
        .btn-danger:hover { background: #dc2626; }
        .btn-secondary { background: #f1f5f9; border: none; color: var(--text-primary); }
        .btn-secondary:hover { background: #e2e8f0; color: var(--text-primary); }
        .btn-success { background: #10b981; border: none; }
        .btn-success:hover { background: #059669; }

        /* ── Table ── */
        .table { font-size: 0.875rem; }
        .table thead th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 16px;
        }
        .table tbody td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table tbody tr:hover { background: #f8fafc; }
        .table tbody tr:last-child td { border-bottom: none; }

        /* ── Form Controls ── */
        .form-label { font-weight: 500; font-size: 0.875rem; color: #374151; margin-bottom: 6px; }
        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(45,106,159,0.12);
            background: #fff;
        }

        /* ── Alerts ── */
        .alert { border: none; border-radius: 10px; font-size: 0.875rem; padding: 12px 16px; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .alert-warning { background: #fef3c7; color: #92400e; }
        .alert-info { background: #dbeafe; color: #1e40af; }

        /* ── Page Header ── */
        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 4px; }
        .page-header p { color: var(--text-muted); font-size: 0.875rem; }

        /* ── Badge ── */
        .badge { border-radius: 6px; font-weight: 500; font-size: 0.75rem; padding: 4px 8px; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .topbar { left: 0; }
            .main-content { margin-left: 0; }
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar') ?>

    <!-- Topbar -->
    <?= $this->include('layouts/header') ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-body">
            <?= $this->include('components/alerts') ?>
            <?= $this->renderSection('content') ?>
        </div>
        <?= $this->include('layouts/footer') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('open');
        });
    </script>
    <?= $this->renderSection('javascript') ?>
</body>
</html>
