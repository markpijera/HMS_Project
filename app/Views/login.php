<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="login-container">
    <div class="login-wrapper">
        <div class="login-left">
            <div class="welcome-content">
                <div class="logo-section">
                    <i class="fas fa-hospital-alt main-icon"></i>
                    <h1>Hospital Management System</h1>
                    <p class="subtitle">Advanced Healthcare Solutions</p>
                </div>
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-user-md"></i>
                        <span>Patient Management</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Appointment Scheduling</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-pills"></i>
                        <span>Medicine Inventory</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics & Reports</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-right">
            <div class="login-form-container">
                <div class="login-header">
                    <h2>Welcome Back</h2>
                    <p>Please sign in to your account</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="/login" method="post" class="login-form">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i>
                            Password
                        </label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>

                <div class="login-footer">
                    <p>Don't have an account? <a href="#" class="signup-link">Contact Administrator</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}

.login-wrapper {
    display: flex;
    width: 100%;
    max-width: 1200px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    overflow: hidden;
    min-height: 600px;
}

.login-left {
    flex: 1;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    position: relative;
}

.login-left::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
}

.welcome-content {
    text-align: center;
    color: white;
    position: relative;
    z-index: 1;
}

.main-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    color: white;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.welcome-content h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 700;
}

.subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 40px;
}

.features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    max-width: 300px;
    margin: 0 auto;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.feature-item i {
    font-size: 1.2rem;
    color: white;
}

.feature-item span {
    font-weight: 500;
}

.login-right {
    flex: 1;
    padding: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.login-form-container {
    width: 100%;
    max-width: 400px;
}

.login-header {
    text-align: center;
    margin-bottom: 30px;
}

.login-header h2 {
    color: #2c3e50;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.login-header p {
    color: #6c757d;
    margin: 0;
}

.alert-error {
    background: #fee;
    color: #c33;
    padding: 12px 16px;
    border-radius: 8px;
    border-left: 4px solid #e74c3c;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.login-form {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-group input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-group input:focus {
    outline: none;
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
}

.password-input {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 4px;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 0.9rem;
    color: #6c757d;
}

.checkmark {
    width: 18px;
    height: 18px;
    border: 2px solid #e9ecef;
    border-radius: 4px;
    position: relative;
    background: white;
}

.remember-me input:checked + .checkmark {
    background: #4facfe;
    border-color: #4facfe;
}

.remember-me input:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    top: -2px;
    left: 2px;
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.forgot-password {
    color: #4facfe;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}

.forgot-password:hover {
    text-decoration: underline;
}

.login-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
}

.login-footer {
    text-align: center;
    margin-top: 20px;
}

.login-footer p {
    color: #6c757d;
    margin: 0;
}

.signup-link {
    color: #4facfe;
    text-decoration: none;
    font-weight: 500;
}

.signup-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .login-wrapper {
        flex-direction: column;
        min-height: auto;
    }

    .login-left {
        padding: 30px 20px;
    }

    .welcome-content h1 {
        font-size: 2rem;
    }

    .features {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .login-right {
        padding: 30px 20px;
    }

    .login-header h2 {
        font-size: 1.5rem;
    }
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye';
    }
}
</script>
<?= $this->endSection() ?>
