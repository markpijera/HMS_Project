<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">
                <i class="fas fa-user-md"></i>
                Doctor Dashboard
            </h1>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="user-details">
                    <span class="user-name">Dr. <?= esc($user['name']) ?></span>
                    <span class="user-role">Medical Professional</span>
                </div>
            </div>
        </div>
        <div class="header-actions">
            <div class="current-date">
                <i class="fas fa-calendar"></i>
                <span id="currentDate"></span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card today-appointments">
            <div class="stat-icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format(count($today_appointments)) ?></h3>
                <p class="stat-label">Today's Appointments</p>
                <div class="stat-trend">
                    <i class="fas fa-clock"></i>
                    <span>Scheduled</span>
                </div>
            </div>
        </div>

        <div class="stat-card total-appointments">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($total_appointments) ?></h3>
                <p class="stat-label">Total Appointments</p>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+12%</span>
                </div>
            </div>
        </div>

        <div class="stat-card pending-appointments">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($pending_appointments) ?></h3>
                <p class="stat-label">Pending Appointments</p>
                <div class="stat-trend">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Requires Attention</span>
                </div>
            </div>
        </div>

        <div class="stat-card completed-appointments">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($completed_appointments) ?></h3>
                <p class="stat-label">Completed Appointments</p>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+8%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="dashboard-grid">
        <!-- Today's Appointments -->
        <div class="dashboard-card today-appointments">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-day"></i>
                    Today's Appointments
                </h3>
                <a href="/appointments" class="view-all">View All</a>
            </div>
            <div class="card-content">
                <?php if (!empty($today_appointments)): ?>
                    <div class="appointment-list">
                        <?php foreach ($today_appointments as $appointment): ?>
                            <div class="appointment-item">
                                <div class="appointment-icon">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                                <div class="appointment-info">
                                    <h4 class="appointment-title">Patient #<?= $appointment['patient_id'] ?></h4>
                                    <p class="appointment-details">
                                        <i class="fas fa-clock"></i>
                                        <?= date('h:i A', strtotime($appointment['appointment_time'])) ?>
                                    </p>
                                    <p class="appointment-details">
                                        <i class="fas fa-stethoscope"></i>
                                        <?= ucfirst($appointment['type']) ?> - <?= ucfirst($appointment['reason']) ?>
                                    </p>
                                    <div class="appointment-status status-<?= $appointment['status'] ?>">
                                        <?= ucfirst($appointment['status']) ?>
                                    </div>
                                </div>
                                <div class="appointment-actions">
                                    <a href="/appointments/show/<?= $appointment['id'] ?>" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/medical-records/new?patient_id=<?= $appointment['patient_id'] ?>&appointment_id=<?= $appointment['id'] ?>" class="btn-record">
                                        <i class="fas fa-file-medical"></i>
                                    </a>
                                    <a href="/prescriptions/new?patient_id=<?= $appointment['patient_id'] ?>" class="btn-prescription">
                                        <i class="fas fa-pills"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <p>No appointments scheduled for today</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- My Patients -->
        <div class="dashboard-card my-patients">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i>
                    My Patients
                </h3>
                <a href="/patients" class="view-all">View All</a>
            </div>
            <div class="card-content">
                <?php if (!empty($my_patients)): ?>
                    <div class="patient-list">
                        <?php foreach (array_slice($my_patients, 0, 5) as $patient): ?>
                            <div class="patient-item">
                                <div class="patient-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="patient-info">
                                    <h4 class="patient-name"><?= esc($patient['name']) ?></h4>
                                    <p class="patient-details">
                                        <i class="fas fa-envelope"></i>
                                        <?= esc($patient['email']) ?>
                                    </p>
                                    <p class="patient-details">
                                        <i class="fas fa-phone"></i>
                                        <?= esc($patient['phone']) ?>
                                    </p>
                                    <p class="patient-details">
                                        <i class="fas fa-calendar"></i>
                                        Last visit: <?= date('M d, Y') ?>
                                    </p>
                                </div>
                                <div class="patient-actions">
                                    <a href="/patients/show/<?= $patient['id'] ?>" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/medical-records/new?patient_id=<?= $patient['id'] ?>" class="btn-record">
                                        <i class="fas fa-file-medical"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-users"></i>
                        <p>No patients assigned yet</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-card quick-actions">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="card-content">
                <div class="action-grid">
                    <a href="/appointments/new" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <span class="action-label">Schedule Appointment</span>
                    </a>

                    <a href="/patients/new" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span class="action-label">Add New Patient</span>
                    </a>

                    <a href="/medical-records" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <span class="action-label">Medical Records</span>
                    </a>

                    <a href="/prescriptions" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <span class="action-label">Prescriptions</span>
                    </a>

                    <a href="/lab-tests" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <span class="action-label">Lab Tests</span>
                    </a>

                    <a href="/account" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="action-label">My Profile</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Prescriptions -->
        <div class="dashboard-card recent-prescriptions">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-pills"></i>
                    Recent Prescriptions
                </h3>
                <a href="/prescriptions" class="view-all">View All</a>
            </div>
            <div class="card-content">
                <?php if (!empty($recent_prescriptions)): ?>
                    <div class="prescription-list">
                        <?php foreach ($recent_prescriptions as $prescription): ?>
                            <div class="prescription-item">
                                <div class="prescription-icon">
                                    <i class="fas fa-prescription-bottle"></i>
                                </div>
                                <div class="prescription-info">
                                    <h4 class="prescription-title">Rx #<?= $prescription['id'] ?></h4>
                                    <p class="prescription-details">
                                        <i class="fas fa-user"></i>
                                        Patient: <?= esc($prescription['name']) ?>
                                    </p>
                                    <p class="prescription-details">
                                        <i class="fas fa-calendar"></i>
                                        <?= date('M d, Y', strtotime($prescription['created_at'])) ?>
                                    </p>
                                    <div class="prescription-status status-<?= $prescription['status'] ?? 'active' ?>">
                                        <?= ucfirst($prescription['status'] ?? 'Active') ?>
                                    </div>
                                </div>
                                <div class="prescription-actions">
                                    <a href="/prescriptions/show/<?= $prescription['id'] ?>" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-prescription-bottle"></i>
                        <p>No recent prescriptions</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-header {
    background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    color: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-avatar {
    font-size: 3rem;
    color: rgba(255,255,255,0.8);
}

.user-details {
    text-align: right;
}

.user-name {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    display: block;
}

.user-role {
    font-size: 0.9rem;
    opacity: 0.8;
    margin: 5px 0 0 0;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.current-date {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    padding: 10px 15px;
    border-radius: 8px;
    font-weight: 500;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-left: 4px solid;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stat-card.today-appointments { border-left-color: #3498db; }
.stat-card.total-appointments { border-left-color: #2ecc71; }
.stat-card.pending-appointments { border-left-color: #f39c12; }
.stat-card.completed-appointments { border-left-color: #9b59b6; }

.stat-icon {
    font-size: 3rem;
    opacity: 0.8;
}

.stat-card.today-appointments .stat-icon { color: #3498db; }
.stat-card.total-appointments .stat-icon { color: #2ecc71; }
.stat-card.pending-appointments .stat-icon { color: #f39c12; }
.stat-card.completed-appointments .stat-icon { color: #9b59b6; }

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    color: #2c3e50;
}

.stat-label {
    font-size: 1rem;
    color: #7f8c8d;
    margin: 5px 0 10px 0;
    font-weight: 500;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.9rem;
    font-weight: 600;
}

.stat-trend i.fa-arrow-up { color: #27ae60; }
.stat-trend i.fa-clock { color: #3498db; }
.stat-trend i.fa-exclamation-triangle { color: #e74c3c; }

.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

.dashboard-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
}

.card-header {
    padding: 20px 25px;
    border-bottom: 1px solid #ecf0f1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 10px;
}

.view-all {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.view-all:hover {
    color: #2980b9;
}

.card-content {
    padding: 25px;
}

.appointment-list, .patient-list, .prescription-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.appointment-item, .patient-item, .prescription-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.3s ease;
}

.appointment-item:hover, .patient-item:hover, .prescription-item:hover {
    background: #e9ecef;
}

.appointment-icon, .patient-avatar, .prescription-icon {
    font-size: 2rem;
    color: #6c757d;
}

.appointment-info, .patient-info, .prescription-info {
    flex: 1;
}

.appointment-title, .patient-name, .prescription-title {
    font-size: 1rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #2c3e50;
}

.appointment-details, .patient-details, .prescription-details {
    font-size: 0.85rem;
    color: #6c757d;
    margin: 2px 0;
    display: flex;
    align-items: center;
    gap: 5px;
}

.appointment-actions, .patient-actions, .prescription-actions {
    display: flex;
    gap: 10px;
}

.btn-view, .btn-record, .btn-prescription {
    color: #3498db;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-view:hover {
    background: #3498db;
    color: white;
}

.btn-record {
    color: #27ae60;
}

.btn-record:hover {
    background: #27ae60;
    color: white;
}

.btn-prescription {
    color: #9b59b6;
}

.btn-prescription:hover {
    background: #9b59b6;
    color: white;
}

.appointment-status, .prescription-status {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-top: 5px;
}

.status-scheduled { background: #f39c12; color: white; }
.status-confirmed { background: #27ae60; color: white; }
.status-completed { background: #3498db; color: white; }
.status-cancelled { background: #e74c3c; color: white; }
.status-active { background: #27ae60; color: white; }
.status-pending { background: #f39c12; color: white; }

.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
    font-size: 1rem;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.action-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    text-decoration: none;
    color: #2c3e50;
    transition: all 0.3s ease;
}

.action-item:hover {
    background: #2ecc71;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
}

.action-icon {
    font-size: 1.5rem;
    color: #6c757d;
}

.action-item:hover .action-icon {
    color: white;
}

.action-label {
    font-weight: 500;
}

@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }

    .dashboard-header {
        padding: 20px;
    }

    .header-content {
        flex-direction: column;
        text-align: center;
    }

    .dashboard-title {
        font-size: 1.5rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .stat-card {
        padding: 20px;
    }

    .stat-number {
        font-size: 2rem;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }

    .card-content {
        padding: 20px;
    }
}
</style>

<script>
// Update current date
document.addEventListener('DOMContentLoaded', function() {
    const currentDateElement = document.getElementById('currentDate');
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    currentDateElement.textContent = now.toLocaleDateString('en-US', options);
});
</script>
<?= $this->endSection() ?>
