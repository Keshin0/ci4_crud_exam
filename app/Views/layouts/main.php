<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $this->renderSection('title') ?> - CI4 CRUD Application</title>
    
    <!-- Bootstrap 5 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Feather Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
    
    <!-- Custom Styles Section -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        
        /* Navbar Styles */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff !important;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
        }
        
        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 8px;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            border-bottom: 2px solid var(--primary-color);
        }
        
        /* Main Content Area */
        main {
            flex: 1;
            padding: 40px 0;
        }
        
        .container-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0 20px;
            margin-top: auto;
        }
        
        footer a {
            color: #0d6efd;
            text-decoration: none;
        }
        
        footer a:hover {
            text-decoration: underline;
        }
        
        .footer-section {
            margin-bottom: 20px;
        }
        
        .footer-section h5 {
            font-weight: 700;
            margin-bottom: 15px;
            color: white;
        }
        
        .footer-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 20px;
            padding-top: 20px;
        }
        
        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }
        
        .alert-info {
            background-color: #cfe2ff;
            color: #084298;
        }
        
        /* User Dropdown */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            main {
                padding: 20px 0;
            }
            
            .user-name {
                display: none;
            }
        }
    </style>
    
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-main">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i data-feather="zap"></i>
                <span>CI4 CRUD</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/dashboard') !== false ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                                <i data-feather="grid" style="width: 18px; height: 18px; margin-right: 5px;"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/records') !== false ? 'active' : '' ?>" href="<?= base_url('records') ?>">
                                <i data-feather="list" style="width: 18px; height: 18px; margin-right: 5px;"></i>Records
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/students') !== false ? 'active' : '' ?>" href="<?= base_url('students') ?>">
                                <i data-feather="users" style="width: 18px; height: 18px; margin-right: 5px;"></i>Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(current_url(), '/profile') !== false ? 'active' : '' ?>" href="<?= base_url('profile') ?>">
                                <i data-feather="user" style="width: 18px; height: 18px; margin-right: 5px;"></i>Profile
                            </a>
                        </li>
                        
                        <!-- User Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="user" style="width: 18px; height: 18px; margin-right: 5px;"></i>
                                <span class="user-name"><?= session()->get('name') ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><h6 class="dropdown-header"><?= session()->get('name') ?></h6></li>
                                <li><small class="dropdown-item disabled text-muted"><?= session()->get('email') ?></small></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i data-feather="settings" style="width: 16px; height: 16px; margin-right: 8px;"></i>Settings</a></li>
                                <li><a class="dropdown-item" href="#"><i data-feather="help-circle" style="width: 16px; height: 16px; margin-right: 8px;"></i>Help</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                        <i data-feather="log-out" style="width: 16px; height: 16px; margin-right: 8px;"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">
                                <i data-feather="log-in" style="width: 18px; height: 18px; margin-right: 5px;"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register') ?>">
                                <i data-feather="user-plus" style="width: 18px; height: 18px; margin-right: 5px;"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main>
        <div class="container-main">
            <!-- Flash Messages -->
            <?= $this->include('components/alerts') ?>

            <!-- Page Content -->
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container-main">
            <div class="row">
                <div class="col-md-4 footer-section">
                    <h5>About This Application</h5>
                    <p>A CodeIgniter 4 CRUD application demonstrating modern web development best practices with Bootstrap 5 styling and RESTful design patterns.</p>
                </div>
                
                <div class="col-md-4 footer-section">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('/') ?>">Home</a></li>
                        <li><a href="<?= base_url('records') ?>">Records</a></li>
                        <li><a href="<?= base_url('students') ?>">Students</a></li>
                        <li><a href="<?= base_url('login') ?>">Login</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 footer-section">
                    <h5>Technologies</h5>
                    <ul class="list-unstyled">
                        <li>CodeIgniter 4</li>
                        <li>Bootstrap 5</li>
                        <li>MySQL Database</li>
                        <li>RESTful API</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-divider">
                <p class="mb-0">&copy; <span id="currentYear"></span> CI4 CRUD Application. All rights reserved. | Developed with <i data-feather="heart" style="width: 16px; height: 16px; color: #dc3545;"></i> using CodeIgniter 4</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Feather Icons-->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        // Initialize feather icons
        feather.replace();
        
        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
    
    <?= $this->renderSection('javascript') ?>
</body>
</html>
