<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>My Profile<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 0;
        margin-bottom: 30px;
    }
    
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .profile-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        background: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .profile-stats {
        display: flex;
        gap: 40px;
        margin-top: 20px;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        display: block;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.9);
    }
    
    .profile-username {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin: 15px 0 5px 0;
    }
    
    .profile-bio {
        color: rgba(255,255,255,0.95);
        font-size: 1rem;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }
    
    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #8e8e8e;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .info-value {
        font-size: 1rem;
        color: #262626;
        font-weight: 500;
    }
    
    .info-icon {
        color: #667eea;
        margin-right: 8px;
    }
    
    .edit-profile-btn {
        background: white;
        color: #667eea;
        border: 2px solid white;
        font-weight: 600;
        padding: 8px 30px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .edit-profile-btn:hover {
        background: transparent;
        color: white;
        border-color: white;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Profile Header -->
<div class="profile-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" 
                         alt="Profile Image" 
                         class="profile-avatar">
                <?php else: ?>
                    <div class="profile-placeholder">
                        <i data-feather="user" style="width: 80px; height: 80px; color: #667eea;"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-9">
                <h1 class="profile-username"><?= esc($user['fullname'] ?? $user['name'] ?? 'User') ?></h1>
                <p class="profile-bio">
                    <?php if (!empty($user['course']) && !empty($user['year_level'])): ?>
                        <?= esc($user['course']) ?> - Year <?= esc($user['year_level']) ?>
                        <?php if (!empty($user['section'])): ?>
                            | Section <?= esc($user['section']) ?>
                        <?php endif; ?>
                    <?php else: ?>
                        Complete your profile to show more information
                    <?php endif; ?>
                </p>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?= !empty($user['student_id']) ? '1' : '0' ?></span>
                        <span class="stat-label">Student ID</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?= !empty($user['course']) ? '1' : '0' ?></span>
                        <span class="stat-label">Course</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?= date('Y') - date('Y', strtotime($user['created_at'] ?? 'now')) ?></span>
                        <span class="stat-label">Years</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="<?= base_url('profile/edit') ?>" class="btn edit-profile-btn">
                        <i data-feather="edit-2" style="width: 16px; height: 16px;"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Information Grid -->
<div class="container">
    <div class="info-grid">
        <!-- Email -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="mail" class="info-icon" style="width: 14px; height: 14px;"></i>
                Email Address
            </div>
            <div class="info-value"><?= esc($user['email'] ?? 'Not set') ?></div>
        </div>
        
        <!-- Student ID -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="credit-card" class="info-icon" style="width: 14px; height: 14px;"></i>
                Student ID
            </div>
            <div class="info-value"><?= esc($user['student_id'] ?? 'Not set') ?></div>
        </div>
        
        <!-- Course -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="book" class="info-icon" style="width: 14px; height: 14px;"></i>
                Course
            </div>
            <div class="info-value"><?= esc($user['course'] ?? 'Not set') ?></div>
        </div>
        
        <!-- Year Level -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="award" class="info-icon" style="width: 14px; height: 14px;"></i>
                Year Level
            </div>
            <div class="info-value"><?= !empty($user['year_level']) ? esc($user['year_level']) . ' Year' : 'Not set' ?></div>
        </div>
        
        <!-- Section -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="users" class="info-icon" style="width: 14px; height: 14px;"></i>
                Section
            </div>
            <div class="info-value"><?= esc($user['section'] ?? 'Not set') ?></div>
        </div>
        
        <!-- Phone -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="phone" class="info-icon" style="width: 14px; height: 14px;"></i>
                Phone Number
            </div>
            <div class="info-value"><?= esc($user['phone'] ?? 'Not set') ?></div>
        </div>
        
        <!-- Address -->
        <div class="info-card" style="grid-column: span 2;">
            <div class="info-label">
                <i data-feather="map-pin" class="info-icon" style="width: 14px; height: 14px;"></i>
                Address
            </div>
            <div class="info-value"><?= esc($user['address'] ?? 'Not set') ?></div>
        </div>
        
        <!-- Account Created -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="calendar" class="info-icon" style="width: 14px; height: 14px;"></i>
                Member Since
            </div>
            <div class="info-value"><?= !empty($user['created_at']) ? date('F d, Y', strtotime($user['created_at'])) : 'N/A' ?></div>
        </div>
        
        <!-- Last Updated -->
        <div class="info-card">
            <div class="info-label">
                <i data-feather="clock" class="info-icon" style="width: 14px; height: 14px;"></i>
                Last Updated
            </div>
            <div class="info-value"><?= !empty($user['updated_at']) ? date('F d, Y', strtotime($user['updated_at'])) : 'N/A' ?></div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    feather.replace();
</script>
<?= $this->endSection() ?>
