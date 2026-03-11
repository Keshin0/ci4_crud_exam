<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Profile<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .edit-profile-container {
        max-width: 900px;
        margin: 40px auto;
    }
    
    .profile-edit-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .profile-edit-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px;
        text-align: center;
        color: white;
    }
    
    .profile-edit-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.75rem;
    }
    
    .profile-edit-body {
        padding: 40px;
    }
    
    .avatar-upload-section {
        text-align: center;
        padding: 30px;
        background: #fafafa;
        border-radius: 12px;
        margin-bottom: 30px;
    }
    
    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        margin-bottom: 20px;
    }
    
    .avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: white;
        border: 4px solid #e0e0e0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .upload-btn-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .upload-btn {
        background: #667eea;
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }
    
    .upload-btn:hover {
        background: #5568d3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .upload-btn-wrapper input[type=file] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .form-section {
        margin-bottom: 30px;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #262626;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .form-label {
        font-weight: 600;
        color: #262626;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border: 1px solid #dbdbdb;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        padding-top: 30px;
        border-top: 2px solid #f0f0f0;
    }
    
    .btn-save {
        background: #667eea;
        color: white;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
    }
    
    .btn-save:hover {
        background: #5568d3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .btn-cancel {
        background: #f0f0f0;
        color: #262626;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
    }
    
    .btn-cancel:hover {
        background: #e0e0e0;
    }
    
    .upload-hint {
        font-size: 0.85rem;
        color: #8e8e8e;
        margin-top: 10px;
    }
    
    .required-badge {
        color: #e74c3c;
        font-weight: 700;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="edit-profile-container">
    <div class="profile-edit-card">
        <div class="profile-edit-header">
            <h2><i data-feather="edit-3" style="width: 24px; height: 24px;"></i> Edit Profile</h2>
        </div>
        
        <div class="profile-edit-body">
            <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <!-- Avatar Upload Section -->
                <div class="avatar-upload-section">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img id="preview" 
                             src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" 
                             alt="Profile Preview" 
                             class="avatar-preview">
                    <?php else: ?>
                        <img id="preview" 
                             src="" 
                             alt="Profile Preview" 
                             class="avatar-preview d-none">
                        <div id="placeholder" class="avatar-placeholder">
                            <i data-feather="user" style="width: 60px; height: 60px; color: #8e8e8e;"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="upload-btn-wrapper">
                        <button class="upload-btn" type="button">
                            <i data-feather="camera" style="width: 16px; height: 16px;"></i> Change Photo
                        </button>
                        <input type="file" name="profile_image" id="profile_image" accept="image/*">
                    </div>
                    
                    <?php if (isset($errors['profile_image'])): ?>
                        <div class="text-danger mt-2"><?= esc($errors['profile_image']) ?></div>
                    <?php endif; ?>
                    <div class="upload-hint">JPG, PNG or WEBP. Max size 2MB</div>
                </div>
                
                <!-- Basic Information -->
                <div class="form-section">
                    <div class="section-title">Basic Information</div>
                    
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name <span class="required-badge">*</span></label>
                            <input type="text" 
                                   name="fullname" 
                                   id="fullname" 
                                   class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('fullname', esc($user['fullname'] ?? $user['name'] ?? '')) ?>" 
                                   required>
                            <?php if (isset($errors['fullname'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['fullname']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span class="required-badge">*</span></label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('email', esc($user['email'] ?? '')) ?>" 
                                   required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Academic Information -->
                <div class="form-section">
                    <div class="section-title">Academic Information</div>
                    
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" 
                                   name="student_id" 
                                   id="student_id" 
                                   class="form-control <?= isset($errors['student_id']) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>" 
                                   placeholder="e.g., 2021-00123">
                            <?php if (isset($errors['student_id'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['student_id']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" 
                                   name="course" 
                                   id="course" 
                                   class="form-control <?= isset($errors['course']) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('course', esc($user['course'] ?? '')) ?>" 
                                   placeholder="e.g., BSIT, BSCS">
                            <?php if (isset($errors['course'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['course']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="year_level" class="form-label">Year Level</label>
                            <select name="year_level" 
                                    id="year_level" 
                                    class="form-select <?= isset($errors['year_level']) ? 'is-invalid' : '' ?>">
                                <option value="">Select Year Level</option>
                                <option value="1" <?= old('year_level', $user['year_level'] ?? '') == '1' ? 'selected' : '' ?>>1st Year</option>
                                <option value="2" <?= old('year_level', $user['year_level'] ?? '') == '2' ? 'selected' : '' ?>>2nd Year</option>
                                <option value="3" <?= old('year_level', $user['year_level'] ?? '') == '3' ? 'selected' : '' ?>>3rd Year</option>
                                <option value="4" <?= old('year_level', $user['year_level'] ?? '') == '4' ? 'selected' : '' ?>>4th Year</option>
                                <option value="5" <?= old('year_level', $user['year_level'] ?? '') == '5' ? 'selected' : '' ?>>5th Year</option>
                            </select>
                            <?php if (isset($errors['year_level'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['year_level']) ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="section" class="form-label">Section</label>
                            <input type="text" 
                                   name="section" 
                                   id="section" 
                                   class="form-control <?= isset($errors['section']) ? 'is-invalid' : '' ?>" 
                                   value="<?= old('section', esc($user['section'] ?? '')) ?>" 
                                   placeholder="e.g., IT3A">
                            <?php if (isset($errors['section'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['section']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="form-section">
                    <div class="section-title">Contact Information</div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" 
                               name="phone" 
                               id="phone" 
                               class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
                               value="<?= old('phone', esc($user['phone'] ?? '')) ?>" 
                               placeholder="e.g., 09XX-XXX-XXXX">
                        <?php if (isset($errors['phone'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['phone']) ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" 
                                  id="address" 
                                  rows="3" 
                                  class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" 
                                  placeholder="Enter your home address"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['address']) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="<?= base_url('profile') ?>" class="btn btn-cancel">
                        <i data-feather="x" style="width: 16px; height: 16px;"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i data-feather="check" style="width: 16px; height: 16px;"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    feather.replace();

    // Live image preview
    document.getElementById('profile_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                const placeholder = document.getElementById('placeholder');
                
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                
                if (placeholder) {
                    placeholder.classList.add('d-none');
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<?= $this->endSection() ?>
