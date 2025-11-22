<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1><i class="fas fa-cogs me-2"></i>System Settings</h1>
	</div>

	<?php if (session()->has('message')): ?>
		<div class="alert alert-success">
			<?= esc(session('message')) ?>
		</div>
	<?php endif; ?>

	<div class="card">
		<div class="card-body">
			<form action="/settings" method="post">
				<?= csrf_field() ?>

				<div class="row mb-3">
					<div class="col-md-6">
						<label class="form-label">Hospital Name</label>
						<input type="text" name="hospital_name" class="form-control" value="<?= esc($settings['hospital_name'] ?? '') ?>">
					</div>
					<div class="col-md-6">
						<label class="form-label">Hospital Website</label>
						<input type="text" name="hospital_website" class="form-control" value="<?= esc($settings['hospital_website'] ?? '') ?>">
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-md-6">
						<label class="form-label">Contact Email</label>
						<input type="email" name="hospital_email" class="form-control" value="<?= esc($settings['hospital_email'] ?? '') ?>">
					</div>
					<div class="col-md-6">
						<label class="form-label">Contact Phone</label>
						<input type="text" name="hospital_phone" class="form-control" value="<?= esc($settings['hospital_phone'] ?? '') ?>">
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label">Hospital Address</label>
					<textarea name="hospital_address" class="form-control" rows="3"><?= esc($settings['hospital_address'] ?? '') ?></textarea>
				</div>

				<div class="d-flex justify-content-end mt-4">
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-save me-1"></i>Save Settings
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
