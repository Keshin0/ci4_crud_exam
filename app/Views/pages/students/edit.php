<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1>Edit Student</h1>
    <a href="/students" class="btn btn-secondary mb-3">Back</a>
    <form action="/students/update/<?= $student['id'] ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $student['name']) ?>" required>
            <?php if (isset($errors['name'])): ?>
                <div class="text-danger"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= old('description', $student['description']) ?></textarea>
            <?php if (isset($errors['description'])): ?>
                <div class="text-danger"><?= $errors['description'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" value="<?= old('course', $student['course']) ?>" required>
            <?php if (isset($errors['course'])): ?>
                <div class="text-danger"><?= $errors['course'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone', $student['phone']) ?>" required>
            <?php if (isset($errors['phone'])): ?>
                <div class="text-danger"><?= $errors['phone'] ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?= $this->endSection() ?>