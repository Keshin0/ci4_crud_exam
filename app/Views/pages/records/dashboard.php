<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Records Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Page Header -->
    <div class="mb-5">
        <h1 class="mb-2">
            <i data-feather="grid" style="width: 32px; height: 32px; margin-right: 10px; vertical-align: -8px;"></i>Records Dashboard
        </h1>
        <p class="text-muted">Overview and management of all your records</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <!-- Total Records -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="d-block text-muted text-uppercase fw-bold mb-2">Total Records</small>
                            <h3 class="mb-0"><?= $stats['total'] ?? 0 ?></h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: #e7f1ff; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i data-feather="list" style="width: 28px; height: 28px; color: #0d6efd;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Records -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="d-block text-muted text-uppercase fw-bold mb-2">Active</small>
                            <h3 class="mb-0 text-success"><?= $stats['active'] ?? 0 ?></h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: #d1e7dd; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i data-feather="check-circle" style="width: 28px; height: 28px; color: #198754;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inactive Records -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="d-block text-muted text-uppercase fw-bold mb-2">Inactive</small>
                            <h3 class="mb-0 text-secondary"><?= $stats['inactive'] ?? 0 ?></h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: #f0f0f0; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i data-feather="x-circle" style="width: 28px; height: 28px; color: #6c757d;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Records -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="d-block text-muted text-uppercase fw-bold mb-2">Pending</small>
                            <h3 class="mb-0 text-warning"><?= $stats['pending'] ?? 0 ?></h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: #fff3cd; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i data-feather="clock" style="width: 28px; height: 28px; color: #ff9800;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex gap-2 flex-wrap">
                <a href="<?= base_url('records') ?>" class="btn btn-outline-primary">
                    <i data-feather="list" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>View All Records
                </a>
                <a href="<?= base_url('records/new') ?>" class="btn btn-primary">
                    <i data-feather="plus" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>Create New Record
                </a>
                <a href="<?= base_url('records') ?>?status=active" class="btn btn-outline-success">
                    <i data-feather="check-circle" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>View Active
                </a>
                <a href="<?= base_url('records') ?>?status=pending" class="btn btn-outline-warning">
                    <i data-feather="clock" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>View Pending
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Records Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i data-feather="history" style="width: 20px; height: 20px; margin-right: 10px; vertical-align: -3px;"></i>Recent Records
                    </h5>
                    <a href="<?= base_url('records') ?>" class="btn btn-sm btn-link text-primary">View All</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 30%">Title</th>
                                <th style="width: 35%">Description</th>
                                <th style="width: 15%">Status</th>
                                <th style="width: 10%">Created</th>
                                <th style="width: 5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentRecords)): ?>
                                <?php foreach ($recentRecords as $record): ?>
                                    <tr>
                                        <td><small class="text-muted"><?= $record['id']; ?></small></td>
                                        <td>
                                            <a href="<?= base_url('records/' . $record['id']) ?>" class="text-decoration-none">
                                                <strong><?= esc($record['title']); ?></strong>
                                            </a>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= substr(esc($record['description']), 0, 50); ?>...
                                            </small>
                                        </td>
                                        <td>
                                            <?php 
                                                $statusClass = match($record['status']) {
                                                    'active' => 'bg-success',
                                                    'inactive' => 'bg-secondary',
                                                    'pending' => 'bg-warning',
                                                    default => 'bg-info'
                                                };
                                            ?>
                                            <span class="badge <?= $statusClass; ?>">
                                                <?= ucfirst($record['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('M d, Y', strtotime($record['created_at'])); ?>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('records/' . $record['id']) ?>" class="btn btn-sm btn-outline-primary" title="View">
                                                <i data-feather="eye" style="width: 14px; height: 14px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i data-feather="inbox" style="width: 48px; height: 48px; color: #ccc; margin-bottom: 15px; display: block;"></i>
                                        <p class="text-muted mb-0">No records yet. <a href="<?= base_url('records/new') ?>">Create one now</a></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
