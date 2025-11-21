<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Edit Patient</h1>

    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/patients/update/<?= esc($patient['patient_id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?= old('first_name', esc($patient['first_name'])) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?= old('last_name', esc($patient['last_name'])) ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="<?= old('date_of_birth', esc($patient['date_of_birth'])) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender" id="gender">
                    <option value="Male" <?= old('gender', $patient['gender']) === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= old('gender', $patient['gender']) === 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= old('gender', $patient['gender']) === 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="<?= old('phone', esc($patient['phone'])) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= old('email', esc($patient['email'])) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" id="address" rows="3"><?= old('address', esc($patient['address'])) ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="blood_type">Blood Type</label>
                <input type="text" class="form-control" name="blood_type" id="blood_type" value="<?= old('blood_type', esc($patient['blood_type'])) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input type="text" class="form-control" name="status" id="status" value="<?= old('status', esc($patient['status'])) ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="emergency_contact">Emergency Contact</label>
                <input type="text" class="form-control" name="emergency_contact" id="emergency_contact" value="<?= old('emergency_contact', esc($patient['emergency_contact'])) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="emergency_phone">Emergency Phone</label>
                <input type="text" class="form-control" name="emergency_phone" id="emergency_phone" value="<?= old('emergency_phone', esc($patient['emergency_phone'])) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="medical_history">Medical History</label>
            <textarea class="form-control" name="medical_history" id="medical_history" rows="3"><?= old('medical_history', esc($patient['medical_history'])) ?></textarea>
        </div>
        <div class="form-group">
            <label for="allergies">Allergies</label>
            <textarea class="form-control" name="allergies" id="allergies" rows="3"><?= old('allergies', esc($patient['allergies'])) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Patient</button>
        <a href="/patients" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?= $this->endSection() ?>
