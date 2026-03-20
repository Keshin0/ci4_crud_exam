<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Records<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Records Management</h1>
        <p>Create, read, update, and delete your records</p>
    </div>
    <a href="<?= base_url('records/new') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add New Record
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><small class="text-muted"><?= $record['id'] ?></small></td>
                            <td>
                                <a href="<?= base_url('records/' . $record['id']) ?>" class="text-decoration-none fw-600" style="font-weight:600;color:#1e293b;">
                                    <?= esc($record['title']) ?>
                                </a>
                            </td>
                            <td><small class="text-muted"><?= substr(esc($record['description']), 0, 60) ?>...</small></td>
                            <td>
                                <?php $sc = match($record['status']) {
                                    'active'   => 'background:#d1fae5;color:#065f46;',
                                    'inactive' => 'background:#f1f5f9;color:#475569;',
                                    'pending'  => 'background:#fef3c7;color:#92400e;',
                                    default    => 'background:#dbeafe;color:#1e40af;'
                                }; ?>
                                <span class="badge" style="<?= $sc ?> border-radius:6px;font-weight:500;">
                                    <?= ucfirst($record['status']) ?>
                                </span>
                            </td>
                            <td><small class="text-muted"><?= date('M d, Y', strtotime($record['created_at'])) ?></small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('records/' . $record['id'] . '/edit') ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $record['id'] ?>)" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size:2.5rem;color:#cbd5e1;display:block;margin-bottom:10px;"></i>
                            <span class="text-muted">No records found</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($pager): ?>
    <div class="d-flex justify-content-center mt-4">
        <?= $pager->links('default', 'default_full') ?>
    </div>
<?php endif; ?>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-header" style="border-bottom:1px solid #f1f5f9;">
                <h5 class="modal-title fw-600">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete this record? This action cannot be undone.</p>
            </div>
            <div class="modal-footer" style="border-top:1px solid #f1f5f9;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function confirmDelete(id) {
        document.getElementById('deleteForm').action = '<?= base_url("records") ?>/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
<?= $this->endSection() ?>
