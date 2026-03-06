<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= esc($record['title']) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Back Navigation -->
            <div class="mb-4">
                <a href="<?= base_url('records') ?>" class="btn btn-sm btn-outline-secondary">
                    <i data-feather="arrow-left" style="width: 16px; height: 16px; margin-right: 5px; vertical-align: -2px;"></i>Back to Records
                </a>
            </div>

            <!-- Record Details Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title mb-0">
                                <i data-feather="file-text" style="width: 24px; height: 24px; margin-right: 10px; vertical-align: -4px;"></i><?= esc($record['title']); ?>
                            </h4>
                        </div>
                        <div class="col-auto">
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
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted fw-bold mb-2">
                            <i data-feather="align-left" style="width: 16px; height: 16px; margin-right: 8px; vertical-align: -2px;"></i>Description
                        </h6>
                        <p class="mt-2">
                            <?= nl2br(esc($record['description'])); ?>
                        </p>
                    </div>

                    <!-- Record Metadata -->
                    <div class="row mt-5 pt-4 border-top">
                        <div class="col-md-6 mb-3">
                            <small class="d-block text-muted text-uppercase fw-bold">Created Date</small>
                            <div class="mt-2">
                                <i data-feather="calendar" style="width: 16px; height: 16px; margin-right: 8px; color: #0d6efd; vertical-align: -2px;"></i>
                                <strong><?= date('F d, Y \a\t H:i', strtotime($record['created_at'])); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="d-block text-muted text-uppercase fw-bold">Last Updated</small>
                            <div class="mt-2">
                                <i data-feather="edit" style="width: 16px; height: 16px; margin-right: 8px; color: #0d6efd; vertical-align: -2px;"></i>
                                <strong><?= date('F d, Y \a\t H:i', strtotime($record['updated_at'])); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer with Actions -->
                <div class="card-footer bg-light border-top">
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('records/' . $record['id'] . '/edit') ?>" class="btn btn-primary">
                            <i data-feather="edit-2" style="width: 16px; height: 16px; margin-right: 8px; vertical-align: -2px;"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $record['id']; ?>)">
                            <i data-feather="trash-2" style="width: 16px; height: 16px; margin-right: 8px; vertical-align: -2px;"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        function confirmDelete(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '<?= base_url("records") ?>/' + id;
            
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
<?= $this->endSection() ?>
