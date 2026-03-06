<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Records<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i data-feather="list" style="width: 32px; height: 32px; margin-right: 10px; vertical-align: -8px;"></i>Records Management
            </h1>
            <p class="text-muted mt-2">Create, read, update, and delete your records</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="<?= base_url('records/new') ?>" class="btn btn-primary">
                <i data-feather="plus" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>Add New Record
            </a>
        </div>
    </div>

    <!-- Records Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 25%">Title</th>
                        <th style="width: 35%">Description</th>
                        <th style="width: 15%">Status</th>
                        <th style="width: 10%">Created</th>
                        <th style="width: 10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($records)): ?>
                        <?php foreach ($records as $record): ?>
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
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('records/' . $record['id'] . '/edit') ?>" 
                                           class="btn btn-warning" title="Edit">
                                            <i data-feather="edit-2" style="width: 16px; height: 16px;"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" 
                                                onclick="confirmDelete(<?= $record['id']; ?>)" title="Delete">
                                            <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i data-feather="inbox" style="width: 48px; height: 48px; color: #ccc; margin-bottom: 15px;"></i>
                                <p class="text-muted mb-0">No records found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
        <div class="d-flex justify-content-center mt-5">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    <?php endif; ?>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete this record? This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                            <i data-feather="trash-2" style="width: 16px; height: 16px; margin-right: 5px; vertical-align: -2px;"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script>
        /**
         * Confirm delete action with Bootstrap modal
         * @param {number} id - Record ID to delete
         */
        function confirmDelete(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '<?= base_url("records") ?>/' + id;
            
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
<?= $this->endSection() ?>
