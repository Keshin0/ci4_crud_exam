<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1>Student Details</h1>
    <a href="/students" class="btn btn-secondary mb-3">Back</a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $student['name'] ?></h5>
            <p class="card-text"><strong>Description:</strong> <?= $student['description'] ?></p>
            <p class="card-text"><strong>Course:</strong> <?= $student['course'] ?></p>
            <p class="card-text"><strong>Phone:</strong> <?= $student['phone'] ?></p>
            <p class="card-text"><strong>Created At:</strong> <?= $student['created_at'] ?></p>
            <p class="card-text"><strong>Updated At:</strong> <?= $student['updated_at'] ?></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>