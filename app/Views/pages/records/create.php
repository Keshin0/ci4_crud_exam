<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Create Record<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <h1>Create New Record</h1>
    <p>Fill in the form below to create a new record</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('records/create') ?>" method="POST" novalidate>
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($validation) && $validation->hasError('title') ? 'is-invalid' : '' ?>"
                               id="title" name="title" placeholder="Enter record title" value="<?= old('title') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('title')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('title') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control <?= isset($validation) && $validation->hasError('description') ? 'is-invalid' : '' ?>"
                                  id="description" name="description" rows="5" placeholder="Enter detailed description" required><?= old('description') ?></textarea>
                        <?php if (isset($validation) && $validation->hasError('description')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('description') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select <?= isset($validation) && $validation->hasError('status') ? 'is-invalid' : '' ?>"
                                id="status" name="status" required>
                            <option value="">-- Select Status --</option>
                            <option value="active"   <?= old('status') === 'active'   ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            <option value="pending"  <?= old('status') === 'pending'  ? 'selected' : '' ?>>Pending</option>
                        </select>
                        <?php if (isset($validation) && $validation->hasError('status')): ?>
                            <div class="invalid-feedback"><?= $validation->getError('status') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Save Record
                        </button>
                        <a href="<?= base_url('records') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
