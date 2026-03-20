<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 50%, #1a8a6e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }
        .auth-wrapper { width: 100%; max-width: 460px; }
        .auth-logo { text-align: center; margin-bottom: 28px; }
        .auth-logo .logo-icon {
            width: 64px; height: 64px;
            background: rgba(255,255,255,0.2);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
            margin-bottom: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .auth-logo h1 { color: #fff; font-size: 1.4rem; font-weight: 700; }
        .auth-logo p { color: rgba(255,255,255,0.7); font-size: 0.875rem; }
        .auth-card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            padding: 36px 40px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
        }
        .auth-card h2 { font-size: 1.5rem; font-weight: 700; color: #1a202c; margin-bottom: 6px; }
        .auth-card .subtitle { color: #718096; font-size: 0.875rem; margin-bottom: 28px; }
        .form-label { font-weight: 500; font-size: 0.875rem; color: #374151; margin-bottom: 6px; }
        .input-group-text {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: #94a3b8;
            border-radius: 10px 0 0 10px !important;
        }
        .form-control {
            border: 1.5px solid #e2e8f0;
            border-left: none;
            border-radius: 0 10px 10px 0 !important;
            padding: 11px 14px;
            font-size: 0.9rem;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #2d6a9f;
            box-shadow: 0 0 0 3px rgba(45,106,159,0.12);
            background: #fff;
        }
        .btn-primary {
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(45,106,159,0.35);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(45,106,159,0.45); }
        .auth-footer { text-align: center; margin-top: 20px; font-size: 0.875rem; color: #718096; }
        .auth-footer a { color: #2d6a9f; font-weight: 500; text-decoration: none; }
        .auth-footer a:hover { text-decoration: underline; }
        .alert { border-radius: 10px; font-size: 0.875rem; border: none; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-logo">
            <div class="logo-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <h1>Student Management System</h1>
            <p>Create your student account</p>
        </div>
        <div class="auth-card">
            <h2>Create Account</h2>
            <p class="subtitle">Fill in the details below to register</p>

            <?= $this->include('components/alerts') ?>

            <form action="<?= base_url('register') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control" type="text" name="name" placeholder="Enter your full name" value="<?= old('name') ?>" required>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('name')): ?>
                        <div class="text-danger mt-1" style="font-size:.8rem"><?= $validation->getError('name') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="you@example.com" value="<?= old('email') ?>" required>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger mt-1" style="font-size:.8rem"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control" type="password" name="password" placeholder="Min. 6 characters" required>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                        <div class="text-danger mt-1" style="font-size:.8rem"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input class="form-control" type="password" name="confirm_password" placeholder="Repeat your password" required>
                    </div>
                    <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                        <div class="text-danger mt-1" style="font-size:.8rem"><?= $validation->getError('confirm_password') ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </button>
            </form>
        </div>
        <div class="auth-footer">
            Already have an account? <a href="<?= base_url('login') ?>">Sign in</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
