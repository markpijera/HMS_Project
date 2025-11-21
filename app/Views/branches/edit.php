<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Edit Branch</h1>

    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/branches/update/<?= esc($branch['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', esc($branch['name'])) ?>" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="<?= old('code', esc($branch['code'])) ?>">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3"><?= old('address', esc($branch['address'])) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= old('contact_number', esc($branch['contact_number'])) ?>">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="active" <?= old('status', $branch['status']) === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= old('status', $branch['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Branch</button>
        <a href="/branches" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?= $this->endSection() ?>
