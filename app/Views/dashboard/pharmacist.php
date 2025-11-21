<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">
                <i class="fas fa-pills"></i>
                Pharmacist Dashboard
            </h1>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-pills"></i>
                </div>
                <div class="user-details">
                    <span class="user-name">Pharmacist <?= esc($user['name']) ?></span>
                    <span class="user-role">Pharmacy Professional</span>
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
        <div class="stat-card total-medicines">
            <div class="stat-icon">
                <i class="fas fa-pills"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($total_medicines) ?></h3>
                <p class="stat-label">Total Medicines</p>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+8%</span>
                </div>
            </div>
        </div>

        <div class="stat-card low-stock">
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($low_stock_medicines) ?></h3>
                <p class="stat-label">Low Stock Items</p>
                <div class="stat-trend">
                    <i class="fas fa-arrow-down"></i>
                    <span>-5%</span>
                </div>
            </div>
        </div>

        <div class="stat-card pending-prescriptions">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($pending_prescriptions) ?></h3>
                <p class="stat-label">Pending Prescriptions</p>
                <div class="stat-trend">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Needs Attention</span>
                </div>
            </div>
        </div>

        <div class="stat-card expired-medicines">
            <div class="stat-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number"><?= number_format($expired_medicines) ?></h3>
                <p class="stat-label">Expired Medicines</p>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+2%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="dashboard-grid">
        <!-- Low Stock Alert -->
        <div class="dashboard-card low-stock-alert">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Low Stock Alert
                </h3>
                <a href="/medicines" class="view-all">View All</a>
            </div>
            <div class="card-content">
                <?php if (!empty($medicines_expiring_soon)): ?>
                    <div class="medicine-list">
                        <?php foreach (array_slice($medicines_expiring_soon, 0, 5) as $medicine): ?>
                            <div class="medicine-item">
                                <div class="medicine-icon">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <div class="medicine-info">
                                    <h4 class="medicine-name"><?= esc($medicine['name']) ?></h4>
                                    <p class="medicine-details">
                                        <i class="fas fa-hashtag"></i>
                                        Batch: <?= esc($medicine['batch_number']) ?>
                                    </p>
                                    <p class="medicine-details">
                                        <i class="fas fa-calendar-times"></i>
                                        Expires: <?= date('M d, Y', strtotime($medicine['expiry_date'])) ?>
                                    </p>
                                    <div class="stock-status low">
                                        Low Stock: <?= $medicine['quantity'] ?> remaining
                                    </div>
                                </div>
                                <div class="medicine-actions">
                                    <a href="/medicines/edit/<?= $medicine['id'] ?>" class="btn-restock">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <p>All medicines are well-stocked</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Prescriptions -->
        <div class="dashboard-card recent-prescriptions">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-prescription"></i>
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
                                    <div class="prescription-status status-<?= $prescription['status'] ?? 'pending' ?>">
                                        <?= ucfirst($prescription['status'] ?? 'Pending') ?>
                                    </div>
                                </div>
                                <div class="prescription-actions">
                                    <a href="/prescriptions/show/<?= $prescription['id'] ?>" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/prescriptions/fill/<?= $prescription['id'] ?>" class="btn-fill">
                                        <i class="fas fa-check"></i>
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
                    <a href="/medicines/new" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <span class="action-label">Add Medicine</span>
                    </a>

                    <a href="/prescriptions" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-file-prescription"></i>
                        </div>
                        <span class="action-label">Manage Prescriptions</span>
                    </a>

                    <a href="/medicines?filter=low_stock" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <span class="action-label">Low Stock Items</span>
                    </a>

                    <a href="/medicines?filter=expired" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <span class="action-label">Expired Medicines</span>
                    </a>

                    <a href="/inventory" class="action-item">
                        <div class="action-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <span class="action-label">Inventory Report</span>
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

        <!-- Inventory Overview -->
        <div class="dashboard-card inventory-overview">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    Inventory Overview
                </h3>
            </div>
            <div class="card-content">
                <div class="inventory-stats">
                    <div class="inventory-stat">
                        <div class="stat-circle total">
                            <span class="stat-number"><?= $total_medicines ?></span>
                        </div>
                        <div class="stat-info">
                            <h4>Total Items</h4>
                            <p>In inventory</p>
                        </div>
                    </div>

                    <div class="inventory-stat">
                        <div class="stat-circle low-stock">
                            <span class="stat-number"><?= $low_stock_medicines ?></span>
                        </div>
                        <div class="stat-info">
                            <h4>Low Stock</h4>
                            <p>Need restocking</p>
                        </div>
                    </div>

                    <div class="inventory-stat">
                        <div class="stat-circle expired">
                            <span class="stat-number"><?= $expired_medicines ?></span>
                        </div>
                        <div class="stat-info">
                            <h4>Expired</h4>
                            <p>To be removed</p>
                        </div>
                    </div>
                </div>

                <div class="inventory-alerts">
                    <h4>Alerts & Notifications</h4>
                    <div class="alert-list">
                        <?php if ($low_stock_medicines > 0): ?>
                            <div class="alert-item warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span><?= $low_stock_medicines ?> medicines are running low on stock</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($expired_medicines > 0): ?>
                            <div class="alert-item danger">
                                <i class="fas fa-times-circle"></i>
                                <span><?= $expired_medicines ?> medicines have expired</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($pending_prescriptions > 0): ?>
                            <div class="alert-item info">
                                <i class="fas fa-clock"></i>
                                <span><?= $pending_prescriptions ?> prescriptions awaiting fulfillment</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($low_stock_medicines == 0 && $expired_medicines == 0 && $pending_prescriptions == 0): ?>
                            <div class="alert-item success">
                                <i class="fas fa-check-circle"></i>
                                <span>All systems running smoothly</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
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
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
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

.stat-card.total-medicines { border-left-color: #9b59b6; }
.stat-card.low-stock { border-left-color: #f39c12; }
.stat-card.pending-prescriptions { border-left-color: #3498db; }
.stat-card.expired-medicines { border-left-color: #e74c3c; }

.stat-icon {
    font-size: 3rem;
    opacity: 0.8;
}

.stat-card.total-medicines .stat-icon { color: #9b59b6; }
.stat-card.low-stock .stat-icon { color: #f39c12; }
.stat-card.pending-prescriptions .stat-icon { color: #3498db; }
.stat-card.expired-medicines .stat-icon { color: #e74c3c; }

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
.stat-trend i.fa-arrow-down { color: #e74c3c; }
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

.medicine-list, .prescription-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.medicine-item, .prescription-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.3s ease;
}

.medicine-item:hover, .prescription-item:hover {
    background: #e9ecef;
}

.medicine-icon, .prescription-icon {
    font-size: 2rem;
    color: #6c757d;
}

.medicine-info, .prescription-info {
    flex: 1;
}

.medicine-name, .prescription-title {
    font-size: 1rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #2c3e50;
}

.medicine-details, .prescription-details {
    font-size: 0.85rem;
    color: #6c757d;
    margin: 2px 0;
    display: flex;
    align-items: center;
    gap: 5px;
}

.medicine-actions, .prescription-actions {
    display: flex;
    gap: 10px;
}

.btn-restock, .btn-view, .btn-fill {
    color: #3498db;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-restock:hover {
    background: #3498db;
    color: white;
}

.btn-view:hover {
    background: #3498db;
    color: white;
}

.btn-fill {
    color: #27ae60;
}

.btn-fill:hover {
    background: #27ae60;
    color: white;
}

.stock-status, .prescription-status {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-top: 5px;
}

.stock-status.low { background: #f39c12; color: white; }
.status-pending { background: #f39c12; color: white; }
.status-completed { background: #27ae60; color: white; }
.status-active { background: #27ae60; color: white; }

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
    background: #9b59b6;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(155, 89, 182, 0.3);
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

.inventory-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.inventory-stat {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.stat-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
}

.stat-circle.total { background: #9b59b6; }
.stat-circle.low-stock { background: #f39c12; }
.stat-circle.expired { background: #e74c3c; }

.stat-info h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #2c3e50;
}

.stat-info p {
    font-size: 0.9rem;
    color: #6c757d;
    margin: 0;
}

.inventory-alerts h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 15px 0;
}

.alert-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.alert-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
}

.alert-item.warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.alert-item.danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-item.info {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

.alert-item.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

@media (max-width: 1024px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .inventory-stats {
        grid-template-columns: 1fr;
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

    .inventory-stat {
        padding: 15px;
    }

    .stat-circle {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
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
