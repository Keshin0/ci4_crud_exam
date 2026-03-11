<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    body {
        background: #fafbfc;
    }
    
    .dash-wrap {
        padding: 25px 15px;
    }
    
    .page-head {
        margin-bottom: 28px;
    }
    
    .page-head h2 {
        font-size: 28px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 4px;
    }
    
    .page-head p {
        color: #7f8c8d;
        font-size: 15px;
    }
    
    .stats-row {
        margin-bottom: 25px;
    }
    
    .stat-box {
        background: white;
        padding: 22px 20px;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        margin-bottom: 18px;
        border-top: 3px solid #3498db;
    }
    
    .stat-box.green-top {
        border-top-color: #27ae60;
    }
    
    .stat-box.orange-top {
        border-top-color: #e67e22;
    }
    
    .stat-box.red-top {
        border-top-color: #e74c3c;
    }
    
    .stat-label {
        font-size: 13px;
        color: #95a5a6;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 8px;
    }
    
    .stat-num {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1;
    }
    
    .stat-info {
        font-size: 13px;
        color: #7f8c8d;
        margin-top: 6px;
    }
    
    .main-content {
        margin-bottom: 20px;
    }
    
    .card-box {
        background: white;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #ecf0f1;
    }
    
    .action-item {
        padding: 14px 16px;
        background: #f8f9fa;
        border-radius: 6px;
        margin-bottom: 10px;
        display: block;
        text-decoration: none;
        color: inherit;
        border-left: 3px solid #3498db;
    }
    
    .action-item:hover {
        background: #e8f4f8;
        text-decoration: none;
    }
    
    .action-item.green {
        border-left-color: #27ae60;
    }
    
    .action-item.orange {
        border-left-color: #e67e22;
    }
    
    .action-item.purple {
        border-left-color: #9b59b6;
    }
    
    .action-item h5 {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0 0 3px 0;
    }
    
    .action-item p {
        font-size: 13px;
        color: #7f8c8d;
        margin: 0;
    }
    
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .activity-list li {
        padding: 12px 0;
        border-bottom: 1px solid #ecf0f1;
        display: flex;
        align-items: flex-start;
    }
    
    .activity-list li:last-child {
        border-bottom: none;
    }
    
    .activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #3498db;
        margin-top: 6px;
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    .activity-dot.green {
        background: #27ae60;
    }
    
    .activity-dot.orange {
        background: #e67e22;
    }
    
    .activity-dot.red {
        background: #e74c3c;
    }
    
    .activity-text {
        flex: 1;
    }
    
    .activity-text strong {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .activity-text span {
        color: #7f8c8d;
        font-size: 13px;
    }
    
    .activity-time {
        font-size: 12px;
        color: #95a5a6;
        white-space: nowrap;
        margin-left: 10px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 15px;
    }
    
    .info-item {
        padding: 12px;
        background: #f8f9fa;
        border-radius: 6px;
    }
    
    .info-item label {
        font-size: 12px;
        color: #95a5a6;
        display: block;
        margin-bottom: 4px;
    }
    
    .info-item .value {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
    }
    
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="dash-wrap">
    <div class="container-main">
        <div class="page-head">
            <h2>Dashboard</h2>
            <p>Hi <?= esc(session()->get('name')) ?>, welcome back!</p>
        </div>
        
        <div class="row stats-row">
            <div class="col-md-3 col-sm-6">
                <div class="stat-box">
                    <div class="stat-label">Total Records</div>
                    <div class="stat-num">150</div>
                    <div class="stat-info">+12 this week</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-box green-top">
                    <div class="stat-label">Students</div>
                    <div class="stat-num">44</div>
                    <div class="stat-info">8 new students</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-box orange-top">
                    <div class="stat-label">Pending</div>
                    <div class="stat-num">23</div>
                    <div class="stat-info">Need attention</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-box red-top">
                    <div class="stat-label">Visitors</div>
                    <div class="stat-num">65</div>
                    <div class="stat-info">Last 7 days</div>
                </div>
            </div>
        </div>
        
        <div class="row main-content">
            <div class="col-lg-8">
                <div class="card-box">
                    <h3 class="card-title">Quick Actions</h3>
                    
                    <a href="<?= base_url('records') ?>" class="action-item">
                        <h5>Manage Records</h5>
                        <p>View, create, edit or delete records</p>
                    </a>
                    
                    <a href="<?= base_url('students') ?>" class="action-item green">
                        <h5>Student Management</h5>
                        <p>Access student profiles and information</p>
                    </a>
                    
                    <a href="<?= base_url('profile') ?>" class="action-item orange">
                        <h5>My Profile</h5>
                        <p>Update your personal details and settings</p>
                    </a>
                    
                    <a href="<?= base_url('users') ?>" class="action-item purple">
                        <h5>User Settings</h5>
                        <p>Manage user roles and permissions</p>
                    </a>
                </div>
                
                <div class="card-box">
                    <h3 class="card-title">System Overview</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Database Status</label>
                            <div class="value">Connected</div>
                        </div>
                        <div class="info-item">
                            <label>Server Load</label>
                            <div class="value">Normal</div>
                        </div>
                        <div class="info-item">
                            <label>Last Backup</label>
                            <div class="value">2 hours ago</div>
                        </div>
                        <div class="info-item">
                            <label>Active Sessions</label>
                            <div class="value">12 users</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card-box">
                    <h3 class="card-title">Recent Activity</h3>
                    <ul class="activity-list">
                        <li>
                            <span class="activity-dot"></span>
                            <div class="activity-text">
                                <strong>New record added</strong><br>
                                <span>Record #1523 was created</span>
                            </div>
                            <div class="activity-time">2h ago</div>
                        </li>
                        <li>
                            <span class="activity-dot green"></span>
                            <div class="activity-text">
                                <strong>Student enrolled</strong><br>
                                <span>John Doe joined BSIT</span>
                            </div>
                            <div class="activity-time">5h ago</div>
                        </li>
                        <li>
                            <span class="activity-dot orange"></span>
                            <div class="activity-text">
                                <strong>Profile updated</strong><br>
                                <span>You changed your info</span>
                            </div>
                            <div class="activity-time">1d ago</div>
                        </li>
                        <li>
                            <span class="activity-dot red"></span>
                            <div class="activity-text">
                                <strong>Record deleted</strong><br>
                                <span>Record #1501 removed</span>
                            </div>
                            <div class="activity-time">2d ago</div>
                        </li>
                        <li>
                            <span class="activity-dot"></span>
                            <div class="activity-text">
                                <strong>System backup</strong><br>
                                <span>Automatic backup completed</span>
                            </div>
                            <div class="activity-time">3d ago</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    feather.replace();
</script>
<?= $this->endSection() ?>
