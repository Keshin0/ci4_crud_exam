<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Record<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Page Header -->
            <div class="mb-4">
                <h1 class="mb-2">
                    <i data-feather="edit" style="width: 32px; height: 32px; margin-right: 10px; vertical-align: -8px;"></i>Edit Record
                </h1>
                <p class="text-muted">Update the record information below</p>
            </div>

            <!-- Edit Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="<?= base_url('records/' . $record['id']) ?>" method="POST" novalidate>
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <!-- Title Field -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control <?php if (isset($validation) && $validation->hasError('title')) echo 'is-invalid'; ?>" 
                                   id="title" name="title" placeholder="Enter record title" 
                                   value="<?= old('title') ?? esc($record['title']) ?>" required>
                            <?php if (isset($validation) && $validation->hasError('title')): ?>
                                <div class="invalid-feedback d-block">
                                    <i data-feather="alert-circle" style="width: 14px; height: 14px; margin-right: 5px; vertical-align: -2px;"></i><?= $validation->getError('title') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted d-block mt-2">Minimum 3 characters required</small>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control <?php if (isset($validation) && $validation->hasError('description')) echo 'is-invalid'; ?>" 
                                      id="description" name="description" rows="5" placeholder="Enter detailed description"
                                      required><?= old('description') ?? esc($record['description']) ?></textarea>
                            <?php if (isset($validation) && $validation->hasError('description')): ?>
                                <div class="invalid-feedback d-block">
                                    <i data-feather="alert-circle" style="width: 14px; height: 14px; margin-right: 5px; vertical-align: -2px;"></i><?= $validation->getError('description') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted d-block mt-2">Minimum 10 characters required</small>
                        </div>

                        <!-- Status Field -->
                        <div class="mb-4">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select <?php if (isset($validation) && $validation->hasError('status')) echo 'is-invalid'; ?>" 
                                    id="status" name="status" required>
                                <option value="">-- Select Status --</option>
                                <option value="active" <?= (old('status') ?? $record['status']) === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= (old('status') ?? $record['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="pending" <?= (old('status') ?? $record['status']) === 'pending' ? 'selected' : '' ?>>Pending</option>
                            </select>
                            <?php if (isset($validation) && $validation->hasError('status')): ?>
                                <div class="invalid-feedback d-block">
                                    <i data-feather="alert-circle" style="width: 14px; height: 14px; margin-right: 5px; vertical-align: -2px;"></i><?= $validation->getError('status') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="save" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>Update Record
                            </button>
                            <a href="<?= base_url('records/' . $record['id']) ?>" class="btn btn-outline-secondary">
                                <i data-feather="x" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: -2px;"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Record Info -->
            <div class="mt-4 text-center">
                <small class="text-muted">
                    <i data-feather="calendar" style="width: 14px; height: 14px; margin-right: 5px; vertical-align: -2px;"></i>Created: <?= date('M d, Y H:i', strtotime($record['created_at'])); ?> | 
                    <i data-feather="edit-3" style="width: 14px; height: 14px; margin-right: 5px; vertical-align: -2px;"></i>Last Updated: <?= date('M d, Y H:i', strtotime($record['updated_at'])); ?>
                </small>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
