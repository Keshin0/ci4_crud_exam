<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Edit Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$role      = session('user')['role'] ?? '';
$cancelUrl = $role === 'student' ? base_url('student/dashboard') : base_url('profile');
$updateUrl = $role === 'student' ? base_url('student/profile/update') : base_url('profile/update');
?>

<div class="page-header">
    <h1>Edit Profile</h1>
    <p>Update your personal and academic information</p>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= $updateUrl ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row g-3">

        <!-- Avatar Upload -->
        <div class="col-lg-3">
            <div class="card text-center">
                <div class="card-body py-4">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img id="preview" src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                             class="rounded-circle mb-3"
                             style="width:100px;height:100px;object-fit:cover;border:4px solid #e8f1fa;" alt="Avatar">
                    <?php else: ?>
                        <div id="preview-placeholder" class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width:100px;height:100px;background:linear-gradient(135deg,#1e3a5f,#2d6a9f);font-size:2.5rem;font-weight:700;color:#fff;">
                            <?= strtoupper(substr($user['fullname'] ?? $user['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <img id="preview" src="" class="rounded-circle mb-3 d-none"
                             style="width:100px;height:100px;object-fit:cover;border:4px solid #e8f1fa;" alt="Avatar">
                    <?php endif; ?>

                    <label for="profile_image" class="btn btn-secondary w-100 btn-sm">
                        <i class="bi bi-camera me-1"></i> Change Photo
                    </label>
                    <input type="file" name="profile_image" id="profile_image" accept="image/*" class="d-none">
                    <p class="text-muted mt-2 mb-0" style="font-size:.75rem;">JPG, PNG or WEBP · Max 2MB</p>
                    <?php if (isset($errors['profile_image'])): ?>
                        <div class="text-danger mt-1" style="font-size:.8rem;"><?= esc($errors['profile_image']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Form Fields -->
        <div class="col-lg-9">
            <!-- Basic Info -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5><i class="bi bi-person me-2" style="color:#2d6a9f;"></i>Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullname" class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>"
                                   value="<?= old('fullname', esc($user['fullname'] ?? $user['name'] ?? '')) ?>" required>
                            <?php if (isset($errors['fullname'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['fullname']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                   value="<?= old('email', esc($user['email'] ?? '')) ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?= old('phone', esc($user['phone'] ?? '')) ?>"
                                   placeholder="e.g., 09XX-XXX-XXXX">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                   value="<?= old('address', esc($user['address'] ?? '')) ?>"
                                   placeholder="Enter your home address">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role-based Info -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5><i class="bi bi-person-badge me-2" style="color:#2d6a9f;"></i><?= $role === 'admin' ? 'Admin Information' : 'Teacher Information' ?></h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label"><?= $role === 'admin' ? 'Admin ID' : 'Employee ID' ?></label>
                            <input type="text" name="student_id" class="form-control"
                                   value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>"
                                   placeholder="e.g., EMP-00123">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label"><?= $role === 'admin' ? 'Office / Unit' : 'Department' ?></label>
                            <input type="text" name="course" class="form-control"
                                   value="<?= old('course', esc($user['course'] ?? '')) ?>"
                                   placeholder="e.g., Computer Science">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label"><?= $role === 'admin' ? 'Section Access' : 'Section Handled' ?></label>
                            <input type="text" name="section" class="form-control"
                                   value="<?= old('section', esc($user['section'] ?? '')) ?>"
                                   placeholder="e.g., IT3A">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label"><?= $role === 'admin' ? 'Year Level Access' : 'Year Level Handled' ?></label>
                            <select name="year_level" class="form-select">
                                <option value="">Select Year Level</option>
                                <?php foreach ([1,2,3,4,5] as $y): ?>
                                    <option value="<?= $y ?>" <?= old('year_level', $user['year_level'] ?? '') == $y ? 'selected' : '' ?>>
                                        <?= $y ?><?= ['st','nd','rd','th','th'][$y-1] ?> Year
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-2">
                <a href="<?= $cancelUrl ?>" class="btn btn-secondary">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Save Changes
                </button>
            </div>
        </div>

    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    document.getElementById('profile_image').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            const preview     = document.getElementById('preview');
            const placeholder = document.getElementById('preview-placeholder');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (placeholder) placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    });
</script>
<?= $this->endSection() ?>
