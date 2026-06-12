<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../controllers/auth/registercontroller.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AgroStock - Registro de nuevos usuarios para la plataforma de insumos agrícolas.">
    <title>Crear Cuenta - AgroStock</title>
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-forest: #0f5132;
            --primary-emerald: #198754;
            --accent-mint: #10b981;
            --accent-teal: #0d9488;
            --bg-dark: #0f172a;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --font-title: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 30px rgba(15, 81, 50, 0.08);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.12);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: var(--font-body);
            color: var(--text-dark);
            background-color: var(--bg-light);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .display-font {
            font-family: var(--font-title);
            font-weight: 700;
        }

        /* Split Screen Layout */
        .auth-container {
            display: flex;
            width: 100vw;
            min-height: 100vh;
        }

        /* Brand Side Panel */
        .brand-panel {
            flex: 1.2;
            background: linear-gradient(135deg, #090d16 0%, #152c1e 100%);
            color: #ffffff;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: justify;
            padding: 60px;
            overflow: hidden;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Geometric decorative blobs */
        .brand-panel::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(25, 135, 84, 0.1);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            filter: blur(80px);
            pointer-events: none;
        }

        .brand-header {
            z-index: 10;
        }

        .brand-logo {
            font-family: var(--font-title);
            font-weight: 800;
            font-size: 2rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .brand-logo i {
            color: var(--accent-mint);
            font-size: 2.2rem;
        }

        .brand-body {
            margin-top: auto;
            margin-bottom: auto;
            z-index: 10;
            max-width: 550px;
        }

        .brand-title {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 20px;
        }

        .brand-title span {
            background: linear-gradient(135deg, #a7f3d0 0%, var(--accent-mint) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-features {
            list-style: none;
            padding-left: 0;
            margin-top: 30px;
        }

        .brand-features li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 1.05rem;
            color: #cbd5e1;
        }

        .brand-features li i {
            color: var(--accent-mint);
            font-size: 1.3rem;
            margin-top: 2px;
        }

        .brand-footer {
            margin-top: auto;
            z-index: 10;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* Form Side Panel */
        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background-color: var(--bg-light);
            position: relative;
        }

        .floating-back-btn {
            position: absolute;
            top: 40px;
            right: 40px;
            z-index: 10;
        }

        .btn-back {
            background-color: #ffffff;
            border: 1px solid rgba(15, 81, 50, 0.1);
            color: var(--primary-forest);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-smooth);
        }

        .btn-back:hover {
            background-color: var(--primary-forest);
            color: #ffffff;
            transform: translateX(-3px);
            box-shadow: 0 4px 12px rgba(15, 81, 50, 0.15);
        }

        .register-card {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border: 1px solid rgba(15, 81, 50, 0.05);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-md);
        }

        .register-title {
            color: var(--primary-forest);
            font-weight: 800;
            font-size: 1.85rem;
            margin-bottom: 8px;
            text-align: center;
        }

        .register-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 24px;
        }

        /* Role selectors styles */
        .role-selector-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .role-option {
            flex: 1;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-smooth);
            background-color: #ffffff;
        }

        .role-option:hover {
            border-color: var(--primary-emerald);
            background-color: rgba(25, 135, 84, 0.01);
        }

        .role-option.active {
            border-color: var(--primary-emerald);
            background-color: rgba(25, 135, 84, 0.06);
            color: var(--primary-forest);
            font-weight: 600;
        }

        .role-option i {
            font-size: 1.4rem;
            margin-bottom: 4px;
            display: block;
        }

        /* Form styling */
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.85rem;
            margin-bottom: 6px;
        }

        .input-group {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: var(--text-muted);
            padding-left: 15px;
            padding-right: 15px;
        }

        .form-control {
            border-color: #e2e8f0;
            padding: 11px 15px;
            font-size: 0.95rem;
            color: var(--text-dark);
            background-color: #ffffff;
            transition: var(--transition-smooth);
        }

        .form-control:focus {
            border-color: var(--primary-emerald);
            box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.1);
        }

        .btn-agro-primary {
            background: linear-gradient(135deg, var(--primary-forest) 0%, var(--primary-emerald) 100%);
            color: #ffffff;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 14px rgba(25, 135, 84, 0.25);
            transition: var(--transition-smooth);
            width: 100%;
        }

        .btn-agro-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.35);
            color: #ffffff;
        }

        .btn-agro-primary:disabled {
            background: var(--text-muted);
            transform: none;
            box-shadow: none;
        }

        /* Custom Checkbox */
        .form-check-input:checked {
            background-color: var(--primary-emerald);
            border-color: var(--primary-emerald);
        }

        /* Links styling */
        .text-success-link {
            color: var(--primary-emerald);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .text-success-link:hover {
            color: var(--primary-forest);
            text-decoration: underline;
        }

        /* Password Matching dynamic message */
        .password-feedback {
            font-size: 0.75rem;
            margin-top: 4px;
            display: none;
        }

        /* Toast notifications styling */
        .custom-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1080;
            background: #ffffff;
            border-left: 4px solid var(--primary-emerald);
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateY(150%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .custom-toast.show {
            transform: translateY(0);
        }

        .custom-toast i {
            font-size: 1.3rem;
            color: var(--primary-emerald);
        }

        /* Responsive Breakpoints */
        @media (max-width: 991px) {
            body {
                flex-direction: column;
            }
            .auth-container {
                flex-direction: column;
            }
            .brand-panel {
                padding: 40px;
                flex: none;
                min-height: 35vh;
                justify-content: center;
            }
            .brand-body {
                margin: 0;
            }
            .brand-title {
                font-size: 2rem;
            }
            .brand-features {
                display: none;
            }
            .brand-footer {
                display: none;
            }
            .form-panel {
                padding: 40px 20px;
                flex: 1;
            }
            .floating-back-btn {
                position: fixed;
                top: 20px;
                right: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <!-- BRAND SIDE PANEL -->
        <div class="brand-panel">
            <div class="brand-header">
                <a href="../../Public/index.php" class="brand-logo">
                    <i class="bi bi-patch-check-fill"></i> AgroStock
                </a>
            </div>
            
            <div class="brand-body">
                <h1 class="brand-title">
                    Únete a la red de <span>AgroStock</span> hoy mismo
                </h1>
                <p class="lead text-white-50">
                    Crea tu cuenta de manera autónoma y comienza a interactuar con nuestro catálogo en tiempo real, descargar facturas de compra e iniciar tu control logístico.
                </p>
                
                <ul class="brand-features">
                    <li>
                        <i class="bi bi-bag-check-fill"></i>
                        <div>
                            <strong>Catálogo en Tiempo Real</strong>
                            <p class="small text-white-50 mb-0">Consulta la disponibilidad, fichas técnicas y precios de semillas, fertilizantes y más.</p>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-receipt-cutoff"></i>
                        <div>
                            <strong>Historial de Facturas</strong>
                            <p class="small text-white-50 mb-0">Visualiza, filtra y descarga duplicados legales en PDF de tus compras anteriores.</p>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-headset"></i>
                        <div>
                            <strong>Soporte Agrícola Integrado</strong>
                            <p class="small text-white-50 mb-0">Accede directamente al canal prioritario con asesores y soporte técnico calificado.</p>
                        </div>
                    </li>
                </ul>
            </div>
                        <i class="bi bi-people-fill"></i>
                        <span class="small d-block">Cliente</span>
                    </div>
                    <div class="role-option" onclick="selectRole('Vendedor', this)">
                        <i class="bi bi-person-workspace"></i>
                        <span class="small d-block">Vendedo
            
            <div class="brand-footer">
                <span>&copy; 2026 AgroStock. Versión 1.1 Optimizada (PHP 8.3)</span>
            </div>
        </div>

        <!-- FORM SIDE PANEL -->
        <div class="form-panel">
            <!-- Floating Home Link -->
            <div class="floating-back-btn">
                <a href="../../Public/index.php" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Volver al Inicio
                </a>
            </div>

            <!-- Register Card -->
            <div class="register-card">
                <h2 class="register-title">Crear Cuenta</h2>
                <p class="register-subtitle">Ingresa tus datos para registrarte</p>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger border-0 py-2 px-3 mb-3 rounded-3 text-start fs-8" style="border-left: 4px solid #dc3545 !important; background-color: rgba(220, 53, 69, 0.08);">
                        <i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success border-0 py-2 px-3 mb-3 rounded-3 text-start fs-8" style="border-left: 4px solid var(--primary-emerald) !important; background-color: rgba(25, 135, 84, 0.08);">
                        <i class="bi bi-check-circle-fill me-1 text-success"></i> <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <!-- Dynamic Info Alert Box -->
                <div class="alert alert-success border-0 py-2 px-3 mb-3 rounded-3 text-start fs-8" style="background-color: rgba(25, 135, 84, 0.08); border-left: 4px solid var(--primary-emerald) !important;">
                    <i class="bi bi-people-fill me-1 text-success"></i><strong>Registro Autónomo:</strong> El rol por defecto es <strong>Cliente</strong>. Si eres Administrador o Vendedor, puedes crearlo en este selector de pruebas.
                </div>

                <!-- Interactive Role Selectors for testing -->
                <label class="form-label mb-2 d-block">Selecciona el Rol a Registrar</label>
                <div class="role-selector-container">
                    <div class="role-option active" onclick="selectRole('Cliente', this)">r</span>
                    </div>
                    <div class="role-option" onclick="selectRole('Administrador', this)">
                        <i class="bi bi-person-badge-fill"></i>
                        <span class="small d-block">Admin</span>
                    </div>
                </div>

                <!-- Register Form -->
                <form id="registerForm" method="POST" action="register.php" onsubmit="handleRegisterSubmit(event)">
                    <!-- Hidden field for selected role -->
                    <input type="hidden" id="selectedRole" name="role" value="Cliente">

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Nombre Completo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="registerName" name="name" placeholder="Juan Pérez" required>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="registerEmail" name="email" placeholder="juan.perez@ejemplo.com" required>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control border-end-0" id="registerPassword" name="password" placeholder="••••••••" required oninput="validatePasswords()">
                            <button type="button" class="btn btn-outline-secondary bg-white border-start-0 border-top border-bottom border-end" style="border-color: #e2e8f0; border-radius: 0 10px 10px 0;" onclick="togglePasswordVisibility('registerPassword', 'toggleIcon1')">
                                <i class="bi bi-eye text-muted" id="toggleIcon1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control border-end-0" id="confirmPassword" placeholder="••••••••" required oninput="validatePasswords()">
                            <button type="button" class="btn btn-outline-secondary bg-white border-start-0 border-top border-bottom border-end" style="border-color: #e2e8f0; border-radius: 0 10px 10px 0;" onclick="togglePasswordVisibility('confirmPassword', 'toggleIcon2')">
                                <i class="bi bi-eye text-muted" id="toggleIcon2"></i>
                            </button>
                        </div>
                        <div id="passwordMatchMessage" class="password-feedback"></div>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="mb-4 fs-8">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                <label class="form-check-label text-secondary" for="termsCheck">
                                    Acepto los <a href="#" class="text-success-link">Términos y Condiciones</a> y la Política de Privacidad de AgroStock.
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-agro-primary" id="submitBtn">
                            <i class="bi bi-person-plus-fill me-2"></i> Crear Cuenta
                        </button>

                        <!-- Login Link -->
                        <div class="text-center mt-4 fs-8 text-secondary">
                            ¿Ya tienes una cuenta? <a href="login.php" class="text-success-link">Inicia sesión aquí</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- TOAST NOTIFICATION -->
        <div id="registerSuccessToast" class="custom-toast">
            <i class="bi bi-check-circle-fill"></i>
            <div>
                <strong class="d-block text-dark small" id="toastTitle">Registro Exitoso</strong>
                <span class="text-secondary small" id="toastMessage">Tu cuenta ha sido creada exitosamente.</span>
            </div>
        </div>

        <!-- Bootstrap Bundle with Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Interactive Role Selection
            function selectRole(roleName, element) {
                document.getElementById('selectedRole').value = roleName;
                document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('active'));
                element.classList.add('active');
            }

            // Toggle password fields visibility
            function togglePasswordVisibility(fieldId, iconId) {
                const pwdField = document.getElementById(fieldId);
                const icon = document.getElementById(iconId);
                
                if (pwdField.type === 'password') {
                    pwdField.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    pwdField.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }

            // Client-side passwords match validation
            function validatePasswords() {
                const pwd = document.getElementById('registerPassword').value;
                const confirmPwd = document.getElementById('confirmPassword').value;
                const msgBox = document.getElementById('passwordMatchMessage');
                const submitBtn = document.getElementById('submitBtn');

                if (!confirmPwd) {
                    msgBox.style.display = 'none';
                    submitBtn.disabled = false;
                    return;
                }

                msgBox.style.display = 'block';

                if (pwd === confirmPwd) {
                    msgBox.className = 'password-feedback text-success';
                    msgBox.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i>Las contraseñas coinciden';
                    submitBtn.disabled = false;
                } else {
                    msgBox.className = 'password-feedback text-danger';
                    msgBox.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i>Las contraseñas no coinciden';
                    submitBtn.disabled = true;
                }
            }

            // Handle register form submission simulation
            function handleRegisterSubmit(event) {
                event.preventDefault();
                
                const name = document.getElementById('registerName').value;
                const email = document.getElementById('registerEmail').value;
                const role = document.getElementById('selectedRole').value;
                const submitBtn = document.getElementById('submitBtn');
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Registrando usuario...`;

                setTimeout(() => {
                    // Show Success Toast
                    document.getElementById('toastTitle').innerText = 'Usuario Registrado';
                    document.getElementById('toastMessage').innerText = `¡Felicidades ${name}! Has sido registrado como ${role}.`;
                    
                    const toast = document.getElementById('registerSuccessToast');
                    toast.classList.add('show');
                    
                    setTimeout(() => {
                        toast.classList.remove('show');
                        
                        // In a production backend, here we would submit the form:
                        event.target.submit();
                    }, 2000);
                }, 1500);
            }
        </script>
    </body>
</html>
