<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1>Students</h1>
    <a href="/students/create" class="btn btn-primary mb-3">Add Student</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Course</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><a href="/students/show/<?= $student['id'] ?>"><?= $student['name'] ?></a></td>
                <td><?= $student['description'] ?></td>
                <td><?= $student['course'] ?></td>
                <td><?= $student['phone'] ?></td>
                <td>
                    <a href="/students/edit/<?= $student['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/students/delete/<?= $student['id'] ?>" method="post" style="display:inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>