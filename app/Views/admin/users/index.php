<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="fw-bold mb-0 page-title">
        <i class="bi bi-people-fill me-2 text-danger"></i>User Management
    </h3>
    <a href="<?= base_url('/admin/roles') ?>" class="btn btn-outline-danger btn-sm">
        <i class="bi bi-shield-check me-1"></i>Manage Roles
    </a>
</div>

<div class="alert alert-danger border-0 d-flex align-items-start gap-3 mb-4 small">
    <i class="bi bi-shield-exclamation fs-5 flex-shrink-0 mt-1"></i>
    <div>
        <strong>Admin Only — User Management</strong><br>
        Role changes take effect on the user's <em>next login</em>.
        Deleted users are permanently removed.
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="fw-bold mb-0 text-muted">
            <i class="bi bi-table me-2"></i>All Users
            <span class="badge bg-secondary ms-2"><?= count($users) ?></span>
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th style="width:280px;">Assign New Role</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $i => $user): ?>
                    <?php $isSelf = ($user['id'] == session('user')['id']); ?>
                    <tr>
                        <td class="ps-4 text-muted small"><?= $i + 1 ?></td>
                        <td class="fw-semibold"><?= esc($user['name']) ?></td>
                        <td class="text-muted small"><?= esc($user['email']) ?></td>
                        <td>
                            <?php
                            $badgeColor = match($user['role_name'] ?? '') {
                                'admin'   => 'danger',
                                'teacher' => 'success',
                                'student' => 'primary',
                                default   => 'secondary',
                            };
                            ?>
                            <span class="badge bg-<?= $badgeColor ?>">
                                <?= esc($user['role_label'] ?? 'Unassigned') ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($isSelf): ?>
                                <span class="text-muted small fst-italic">
                                    <i class="bi bi-lock me-1"></i>Cannot change own role
                                </span>
                            <?php else: ?>
                            <form action="<?= base_url('/admin/users/assign-role/' . $user['id']) ?>"
                                  method="POST"
                                  class="d-flex gap-2">
                                <?= csrf_field() ?>
                                <select name="role_id" class="form-select form-select-sm">
                                    <?php foreach ($roles as $roleId => $roleLabel): ?>
                                        <option value="<?= $roleId ?>"
                                            <?= $user['role_id'] == $roleId ? 'selected' : '' ?>>
                                            <?= esc($roleLabel) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-danger flex-shrink-0">
                                    <i class="bi bi-check2"></i> Assign
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($isSelf): ?>
                                <button class="btn btn-sm btn-outline-secondary" disabled title="Cannot delete own account">
                                    <i class="bi bi-lock"></i>
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                        data-id="<?= $user['id'] ?>"
                                        data-name="<?= esc($user['name']) ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-0">Are you sure you want to permanently delete <strong id="deleteUserName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteUserForm" method="POST" action="">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('deleteUserModal').addEventListener('show.bs.modal', function (e) {
        const btn  = e.relatedTarget;
        document.getElementById('deleteUserName').textContent = btn.dataset.name;
        document.getElementById('deleteUserForm').action =
            '<?= base_url('/admin/users/delete/') ?>' + btn.dataset.id;
    });
</script>

<?= $this->endSection() ?>
