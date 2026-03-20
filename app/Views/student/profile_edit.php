<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Edit Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Profile</h3>
        <p class="text-muted small mt-1 mb-0">Update your personal and academic information</p>
    </div>
    <a href="<?= base_url('student/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
    </a>
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

<form action="<?= base_url('student/profile/update') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Avatar -->
        <div class="col-lg-3 text-center">
            <div class="card border-0 shadow-sm p-4">
                <?php if (!empty($user['profile_image'])): ?>
                    <img id="preview" src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         class="rounded-circle border border-4 border-primary mx-auto mb-3"
                         style="width:110px;height:110px;object-fit:cover;" alt="Avatar">
                <?php else: ?>
                    <div id="preview-placeholder" class="rounded-circle bg-primary bg-opacity-10 border border-4 border-primary
                              d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:110px;height:110px;">
                        <i class="bi bi-person-fill text-primary" style="font-size:3rem;"></i>
                    </div>
                    <img id="preview" src="" class="rounded-circle border border-4 border-primary mx-auto mb-3 d-none"
                         style="width:110px;height:110px;object-fit:cover;" alt="Avatar">
                <?php endif; ?>

                <label for="profile_image" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-camera me-1"></i>Change Photo
                </label>
                <input type="file" name="profile_image" id="profile_image" accept="image/*" class="d-none">
                <p class="text-muted small mt-2 mb-0">JPG, PNG or WEBP · Max 2MB</p>
            </div>
        </div>

        <!-- Fields -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <!-- Basic -->
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Basic Information</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullname" class="form-control"
                                   value="<?= old('fullname', esc($user['fullname'] ?? $user['name'] ?? '')) ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                   value="<?= old('email', esc($user['email'] ?? '')) ?>" required>
                        </div>
                    </div>

                    <!-- Academic -->
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Academic Information</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Student ID</label>
                            <input type="text" name="student_id" class="form-control"
                                   value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>"
                                   placeholder="e.g., 2021-00123">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Course</label>
                            <input type="text" name="course" class="form-control"
                                   value="<?= old('course', esc($user['course'] ?? '')) ?>"
                                   placeholder="e.g., BSIT, BSCS">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Year Level</label>
                            <select name="year_level" class="form-select">
                                <option value="">Select Year Level</option>
                                <?php foreach ([1,2,3,4,5] as $y): ?>
                                    <option value="<?= $y ?>" <?= old('year_level', $user['year_level'] ?? '') == $y ? 'selected' : '' ?>>
                                        <?= $y ?><?= ['st','nd','rd','th','th'][$y-1] ?> Year
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Section</label>
                            <input type="text" name="section" class="form-control"
                                   value="<?= old('section', esc($user['section'] ?? '')) ?>"
                                   placeholder="e.g., IT3A">
                        </div>
                    </div>

                    <!-- Contact -->
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Contact Information</h6>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?= old('phone', esc($user['phone'] ?? '')) ?>"
                                   placeholder="e.g., 09XX-XXX-XXXX">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" rows="3" class="form-control"
                                      placeholder="Enter your home address"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-white border-top d-flex justify-content-end gap-2 p-3">
                    <a href="<?= base_url('student/dashboard') ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>Save Changes
                    </button>
                </div>
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
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('preview-placeholder');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (placeholder) placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    });
</script>
<?= $this->endSection() ?>
