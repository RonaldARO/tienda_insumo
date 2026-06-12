<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AgroStock - Sistema integral de inventario, stock y punto de venta para insumos agrícolas. Optimización logística y facturación legal para el agro.">
    <title>AgroStock - Gestión de Inventario y Ventas Agrícolas</title>
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS Fallback / CDN directly -->
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
            background-color: #ffffff;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        h1, h2, h3, h4, h5, h6, .display-font {
            font-family: var(--font-title);
            font-weight: 700;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary-emerald);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-forest);
        }

        /* Glassmorphic Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(15, 81, 50, 0.08);
            transition: var(--transition-smooth);
            padding: 15px 0;
        }

        .navbar-custom.scrolled {
            padding: 10px 0;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-sm);
        }

        .navbar-brand-custom {
            font-family: var(--font-title);
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--primary-forest) !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand-custom i {
            color: var(--accent-mint);
            font-size: 1.8rem;
        }

        .nav-link-custom {
            font-weight: 500;
            color: var(--text-dark) !important;
            padding: 8px 16px !important;
            transition: var(--transition-smooth);
            position: relative;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--accent-mint);
            transition: var(--transition-smooth);
            transform: translateX(-50%);
        }

        .nav-link-custom:hover::after {
            width: 80%;
        }

        .nav-link-custom:hover {
            color: var(--primary-emerald) !important;
        }

        /* Premium Buttons */
        .btn-agro-primary {
            background: linear-gradient(135deg, var(--primary-forest) 0%, var(--primary-emerald) 100%);
            color: #ffffff;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 14px rgba(25, 135, 84, 0.3);
            transition: var(--transition-smooth);
        }

        .btn-agro-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.4);
            color: #ffffff;
        }

        .btn-agro-secondary {
            background: transparent;
            color: var(--primary-forest);
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            border: 2px solid var(--primary-forest);
            transition: var(--transition-smooth);
        }

        .btn-agro-secondary:hover {
            background: rgba(15, 81, 50, 0.05);
            transform: translateY(-2px);
            color: var(--primary-forest);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #090d16 0%, #152c1e 100%);
            color: #ffffff;
            padding: 160px 0 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
        }

        .hero-title span {
            background: linear-gradient(135deg, #a7f3d0 0%, var(--accent-mint) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            font-weight: 300;
            line-height: 1.6;
            color: #cbd5e1;
            margin-bottom: 35px;
        }

        /* Mockup Container */
        .mockup-container {
            position: relative;
            perspective: 1000px;
        }

        .mockup-card {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            padding: 24px;
            transform: rotateY(-8deg) rotateX(5deg);
            transition: var(--transition-smooth);
        }

        .mockup-card:hover {
            transform: rotateY(0deg) rotateX(0deg) translateY(-5px);
        }

        /* KPI Quick Stats Section */
        .stats-section {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(15, 81, 50, 0.05);
            transition: var(--transition-smooth);
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(15, 81, 50, 0.12);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-forest);
            margin-bottom: 5px;
            background: linear-gradient(135deg, var(--primary-forest) 0%, var(--accent-teal) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .stat-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Feature Cards */
        .features-section {
            padding: 100px 0;
            background-color: var(--bg-light);
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-tag {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--primary-emerald);
            background-color: rgba(25, 135, 84, 0.08);
            padding: 6px 16px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 2.25rem;
            color: var(--primary-forest);
        }

        .feature-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 35px;
            border: 1px solid rgba(15, 81, 50, 0.04);
            box-shadow: var(--shadow-sm);
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-md);
            border-color: rgba(25, 135, 84, 0.15);
        }

        .feature-icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: rgba(25, 135, 84, 0.08);
            color: var(--primary-emerald);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 25px;
            transition: var(--transition-smooth);
        }

        .feature-card:hover .feature-icon-wrapper {
            background: var(--primary-emerald);
            color: #ffffff;
            transform: scale(1.05);
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-forest);
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Interactive Simulator Section */
        .simulator-section {
            padding: 100px 0;
            background: #ffffff;
        }

        .sim-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .sim-header {
            background: linear-gradient(135deg, var(--primary-forest) 0%, var(--primary-emerald) 100%);
            color: #ffffff;
            padding: 24px;
        }

        /* Category Cards */
        .category-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 220px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition-smooth);
            cursor: pointer;
            border: none;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.85) 100%);
            z-index: 1;
        }

        .category-card:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-md);
        }

        .category-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px;
            z-index: 2;
            color: #ffffff;
        }

        .category-card i {
            font-size: 2.2rem;
            color: var(--accent-mint);
            margin-bottom: 10px;
            display: inline-block;
        }

        /* CSS based beautiful decorative backgrounds for categories */
        .bg-cat-semillas { background: linear-gradient(135deg, #1e3a1e 0%, #15803d 100%); }
        .bg-cat-fertilizantes { background: linear-gradient(135deg, #134e4a 0%, #0d9488 100%); }
        .bg-cat-agroquimicos { background: linear-gradient(135deg, #1e293b 0%, #475569 100%); }
        .bg-cat-herramientas { background: linear-gradient(135deg, #78350f 0%, #d97706 100%); }

        /* Login Modal & Role selections */
        .role-selector-container {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .role-option {
            flex: 1;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .role-option:hover {
            border-color: var(--primary-emerald);
            background: rgba(25, 135, 84, 0.02);
        }

        .role-option.active {
            border-color: var(--primary-emerald);
            background: rgba(25, 135, 84, 0.08);
            color: var(--primary-forest);
            font-weight: 600;
        }

        .role-option i {
            font-size: 1.5rem;
            margin-bottom: 6px;
            display: block;
        }

        /* Footer */
        .footer-custom {
            background-color: var(--bg-dark);
            color: #94a3b8;
            padding: 80px 0 30px 0;
            border-top: 5px solid var(--primary-emerald);
        }

        .footer-logo {
            font-family: var(--font-title);
            font-weight: 800;
            font-size: 1.8rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .footer-logo i {
            color: var(--accent-mint);
        }

        .footer-title {
            color: #ffffff;
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 8px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background-color: var(--accent-mint);
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .footer-links a:hover {
            color: #ffffff;
            padding-left: 5px;
        }

        /* Toast notifications */
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
    </style>
</head>
<body>

    <!-- NAV BAR -->
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="#inicio">
                <i class="bi bi-patch-check-fill"></i> AgroStock
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#caracteristicas">Características</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#simulador">Simulador Financiero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#categorias">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#tecnologia">Tecnología</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <span class="text-success-emphasis fw-semibold small">
                            <i class="bi bi-person-circle me-1"></i> Hola, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo htmlspecialchars($_SESSION['role_name']); ?>)
                        </span>
                        <a href="../login.php" class="btn btn-agro-secondary btn-sm py-2 px-3">
                            <i class="bi bi-box-arrow-right me-1"></i> Salir
                        </a>
                    <?php else: ?>
                        <a href="../login.php" class="btn btn-agro-primary">
                            <i class="bi bi-lock-fill me-2"></i> Acceso Personal
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="inicio" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill mb-3 fs-7 fw-semibold">
                        <i class="bi bi-stars me-1"></i> Versión 1.1 Optimizada (PHP 8.3)
                    </span>
                    <h1 class="hero-title">
                        Control Total de tus <span>Insumos Agrícolas</span> y Ventas
                    </h1>
                    <p class="hero-subtitle">
                        Una solución profesional diseñada para optimizar inventarios, gestionar lotes, controlar mermas y garantizar la viabilidad financiera de tu agrocomercio en tiempo real.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="../views/auth/login.php" class="btn btn-agro-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Entrar al Panel
                        </a>
                        <a href="#simulador" class="btn btn-agro-secondary btn-lg">
                            <i class="bi bi-calculator me-2"></i> Simular Margen
                        </a>
                    </div>
                </div>
                <!-- Interactive Dashboard Mockup -->
                <div class="col-lg-6">
                    <div class="mockup-container">
                        <div class="mockup-card">
                            <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="bg-success rounded-circle" style="width: 12px; height: 12px; display: inline-block;"></span>
                                    <span class="fw-semibold text-white fs-6">Resumen de Operación (Dashboard)</span>
                                </div>
                                <span class="badge bg-dark text-success-emphasis border border-success border-opacity-25 py-1 px-2">En línea</span>
                            </div>
                            
                            <!-- Dummy metrics in mockup -->
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="bg-dark bg-opacity-50 p-3 rounded border border-secondary border-opacity-10 text-start">
                                        <div class="text-secondary fs-7 mb-1">Ventas del Día</div>
                                        <div class="fw-bold text-white fs-4">$2,450.00</div>
                                        <div class="text-success fs-8"><i class="bi bi-arrow-up-short"></i> +12% vs ayer</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-dark bg-opacity-50 p-3 rounded border border-secondary border-opacity-10 text-start">
                                        <div class="text-secondary fs-7 mb-1">Alertas de Stock</div>
                                        <div class="fw-bold text-warning fs-4">3 Productos</div>
                                        <div class="text-warning fs-8"><i class="bi bi-exclamation-triangle"></i> Revisión urgente</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory Status Progress in mockup -->
                            <div class="bg-dark bg-opacity-50 p-3 rounded border border-secondary border-opacity-10 text-start mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-white fs-7 font-title">Rotación de Categorías</span>
                                    <span class="text-success fs-8">Óptimo</span>
                                </div>
                                <div class="progress bg-secondary bg-opacity-20" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Quick list in mockup -->
                            <div class="text-start fs-8 text-secondary">
                                <div class="d-flex justify-content-between py-1 border-bottom border-secondary border-opacity-10">
                                    <span class="text-white"><i class="bi bi-bookmark-fill text-success me-1"></i> Semilla Maíz Híbrido</span>
                                    <span class="text-white-50">Stock: 120 sacos</span>
                                </div>
                                <div class="d-flex justify-content-between py-1 border-bottom border-secondary border-opacity-10">
                                    <span class="text-white"><i class="bi bi-bookmark-fill text-success me-1"></i> Fertilizante Urea 46%</span>
                                    <span class="text-white-50">Stock: 80 bultos</span>
                                </div>
                                <div class="d-flex justify-content-between py-1">
                                    <span class="text-warning"><i class="bi bi-bookmark-fill text-warning me-1"></i> Glifosato Concentrado</span>
                                    <span class="text-warning">Stock: 5 lts (Min: 10)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS BAR -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">450+</div>
                        <div class="stat-label">Insumos del Agro</div>
                        <div class="stat-desc">Indexados por código y SKU</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Stock Protegido</div>
                        <div class="stat-desc">Bloqueo de stock negativo (RN01)</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">20 Min</div>
                        <div class="stat-label">Sesión Segura</div>
                        <div class="stat-desc">Destrucción automática (RNF01)</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Proveedores</div>
                        <div class="stat-desc">Directorio de insumos integrado</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="caracteristicas" class="features-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Módulos de Sistema</span>
                <h2 class="section-title">Estructura Robusta y Profesional</h2>
                <p class="text-muted col-lg-6 mx-auto mt-2">
                    Nuestra plataforma cubre todo el flujo operativo de tu agrocomercio, garantizando exactitud contable e integridad referencial.
                </p>
            </div>
            
            <div class="row g-4">
                <!-- RF06: Inventario y Alertas -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-bell-fill"></i>
                        </div>
                        <h3>Alertas de Stock</h3>
                        <p>Monitoreo síncrono del stock actual. Alerta automática en el Dashboard cuando las existencias igualan o bajan del stock mínimo de seguridad.</p>
                    </div>
                </div>
                <!-- RF10: Punto de Venta POS -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <h3>Punto de Venta (POS)</h3>
                        <p>Módulo de transacciones bajo modelo ACID en base de datos. Facturación digital instantánea desglosando IVA y descontando stock en caliente.</p>
                    </div>
                </div>
                <!-- RF15: Control Financiero -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3>Rentabilidad Neta</h3>
                        <p>Cálculo en tiempo real de ingresos, egresos y márgenes netos de ganancias para el Administrador según la compra vs venta realizada.</p>
                    </div>
                </div>
                <!-- RF02: RBAC -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h3>Acceso por Roles (RBAC)</h3>
                        <p>Matriz de permisos estricta. Vistas y procesos delimitados para Administrador (gerencia), Vendedor (POS) y Cliente (consultas).</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE SIMULATOR (RN06) -->
    <section id="simulador" class="simulator-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <span class="section-tag">Regla Financiera RN06</span>
                    <h2 class="section-title mb-4">Salvaguarda y Margen de Utilidad</h2>
                    <p class="text-muted">
                        El sistema AgroStock incluye validaciones automáticas integradas. La **Regla de Negocio RN06** bloquea cualquier intento de registrar o actualizar un insumo agrícola cuyo precio de venta sea menor o igual al precio de compra.
                    </p>
                    <p class="text-muted">
                        ¡Prueba la regla tú mismo en el simulador interactivo de la derecha! Ingresa valores de costo y venta para medir la rentabilidad del producto.
                    </p>
                    <div class="p-3 bg-light rounded border-start border-4 border-success mt-4">
                        <div class="fw-semibold text-success fs-6"><i class="bi bi-info-circle-fill me-2"></i>Ecuación de Margen</div>
                        <span class="text-muted small">Utilidad = Venta − Compra. El Margen de Ganancia se calcula en porcentaje sobre el precio final.</span>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="sim-card">
                        <div class="sim-header">
                            <h4 class="mb-0 fs-5"><i class="bi bi-sliders me-2"></i> Simulador de Viabilidad y Margen</h4>
                            <span class="small opacity-75">Simulación directa del motor de validación del backend</span>
                        </div>
                        <div class="p-4">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="simName" class="form-label fw-semibold text-secondary small">Nombre del Insumo Agrícola</label>
                                    <input type="text" class="form-control" id="simName" value="Fertilizante NPK Triple 15" placeholder="Escribe el nombre del insumo">
                                </div>
                                <div class="col-md-6">
                                    <label for="simCompra" class="form-label fw-semibold text-secondary small">Precio de Compra (Costo)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control" id="simCompra" value="25.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="simVenta" class="form-label fw-semibold text-secondary small">Precio de Venta (Público)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control" id="simVenta" value="38.00">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Results display widget -->
                            <div id="simResult" class="p-3 rounded bg-success bg-opacity-10 border border-success border-opacity-20 mb-0">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold fs-6" id="simStatusText"><i class="bi bi-check-circle-fill me-2 text-success"></i>PRODUCTO VIABLE</span>
                                    <span class="badge bg-success" id="simBadge">Aprobado (RN06)</span>
                                </div>
                                <div class="row text-center mt-3">
                                    <div class="col-6 border-end">
                                        <div class="small text-secondary">Utilidad Neta</div>
                                        <div class="fw-bold fs-4 text-success" id="simProfit">$13.00</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small text-secondary">Margen de Ganancia</div>
                                        <div class="fw-bold fs-4 text-success" id="simMargin">34.21%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT CATEGORIES -->
    <section id="categorias" class="features-section" style="background-color: #ffffff;">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Catálogo Estructurado</span>
                <h2 class="section-title">Categorías del Sistema (RF04)</h2>
                <p class="text-muted col-lg-6 mx-auto mt-2">
                    Clasificación jerárquica estricta para la correcta asignación logística y el control fitosanitario de cada lote.
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="category-card bg-cat-semillas">
                        <div class="category-content">
                            <i class="bi bi-flower1"></i>
                            <h4 class="fs-5 mb-1 text-white">Semillas</h4>
                            <p class="small text-white-50 mb-0">Granos, híbridos certificados y variedades de alta germinación.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="category-card bg-cat-fertilizantes">
                        <div class="category-content">
                            <i class="bi bi-droplet-fill"></i>
                            <h4 class="fs-5 mb-1 text-white">Fertilizantes</h4>
                            <p class="small text-white-50 mb-0">Abonos, correctores de suelo, foliares y bioestimulantes.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="category-card bg-cat-agroquimicos">
                        <div class="category-content">
                            <i class="bi bi-prescription2"></i>
                            <h4 class="fs-5 mb-1 text-white">Agroquímicos</h4>
                            <p class="small text-white-50 mb-0">Herbicidas, fungicidas e insecticidas de uso agropecuario.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="category-card bg-cat-herramientas">
                        <div class="category-content">
                            <i class="bi bi-tools"></i>
                            <h4 class="fs-5 mb-1 text-white">Herramientas</h4>
                            <p class="small text-white-50 mb-0">Sistemas de riego, maquinaria menor e insumos manuales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TECH STACK & QUALITY REQUIREMENTS -->
    <section id="tecnologia" class="features-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Requisitos No Funcionales</span>
                <h2 class="section-title">Tecnología y Atributos de Calidad</h2>
                <p class="text-muted col-lg-6 mx-auto mt-2">
                    Construido bajo estándares modernos para garantizar que la aplicación sea robusta, segura y escalable.
                </p>
            </div>
            
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-6 col-lg-3">
                    <div class="bg-white p-4 rounded shadow-sm border h-100">
                        <div class="fs-1 text-success mb-3"><i class="bi bi-filetype-php"></i></div>
                        <h4 class="fs-5">PHP 8.3 OOP</h4>
                        <p class="small text-muted mb-0">Backend basado en arquitectura MVC (Modelo-Vista-Controlador) de tipado estricto y limpio.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-white p-4 rounded shadow-sm border h-100">
                        <div class="fs-1 text-success mb-3"><i class="bi bi-database-fill-check"></i></div>
                        <h4 class="fs-5">MySQL 8.0 InnoDB</h4>
                        <p class="small text-muted mb-0">Garantía transaccional de integridad referencial. Consultas preparadas contra inyecciones SQL.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-white p-4 rounded shadow-sm border h-100">
                        <div class="fs-1 text-success mb-3"><i class="bi bi-shield-fill-check"></i></div>
                        <h4 class="fs-5">Cifrado BCRYPT</h4>
                        <p class="small text-muted mb-0">Protección avanzada de contraseñas de usuario con hashing robusto nativo e irreversible.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-white p-4 rounded shadow-sm border h-100">
                        <div class="fs-1 text-success mb-3"><i class="bi bi-laptop"></i></div>
                        <h4 class="fs-5">Diseño Responsivo</h4>
                        <p class="small text-muted mb-0">Interfaz totalmente adaptativa mediante Bootstrap 5.3 para computadores, tablets o móviles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-5">
                    <a class="footer-logo" href="#">
                        <i class="bi bi-patch-check-fill"></i> AgroStock
                    </a>
                    <p class="small">
                        Un sistema informático robusto desarrollado específicamente para satisfacer las necesidades de control físico y comercial en almacenes de insumos agrícolas y agrocomercio.
                    </p>
                    <p class="small text-white-50 mt-4">
                        Desarrollado bajo especificaciones SRS v1.1
                    </p>
                </div>
                
                <div class="col-md-3 col-lg-2 offset-lg-1">
                    <h5 class="footer-title">Navegación</h5>
                    <ul class="footer-links">
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#caracteristicas">Características</a></li>
                        <li><a href="#simulador">Simulador</a></li>
                        <li><a href="#categorias">Categorías</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 col-lg-3">
                    <h5 class="footer-title">Contacto de Soporte</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-envelope-fill me-2 text-success"></i> support@agrostock.com</li>
                        <li><i class="bi bi-telephone-fill me-2 text-success"></i> +57 (300) 123-4567</li>
                        <li><i class="bi bi-geo-alt-fill me-2 text-success"></i> Montería, Córdoba - Colombia</li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-secondary opacity-25">
            
            <div class="row mt-4 align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="small">&copy; 2026 AgroStock. Todos los derechos reservados.</span>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <span class="small">Autor: <strong class="text-white">Rubén Darío Delgado Cruz</strong></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CUSTOM SCRIPTS -->
    <script>
        // Scroll navbar class toggle
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Initialize Simulator inputs
        document.addEventListener('DOMContentLoaded', () => {
            // Attach event listeners to simulator inputs
            document.getElementById('simCompra').addEventListener('input', calculateSimulator);
            document.getElementById('simVenta').addEventListener('input', calculateSimulator);
            calculateSimulator();
        });

        // Interactive Financial Simulator logic (RN06 & RF15)
        function calculateSimulator() {
            const costVal = parseFloat(document.getElementById('simCompra').value) || 0;
            const sellVal = parseFloat(document.getElementById('simVenta').value) || 0;
            
            const resultBox = document.getElementById('simResult');
            const statusText = document.getElementById('simStatusText');
            const badge = document.getElementById('simBadge');
            const profitText = document.getElementById('simProfit');
            const marginText = document.getElementById('simMargin');
            
            if (sellVal <= costVal) {
                // Rule RN06 violation
                resultBox.className = "p-3 rounded bg-danger bg-opacity-10 border border-danger border-opacity-20 mb-0";
                statusText.innerHTML = `<i class="bi bi-x-circle-fill me-2 text-danger"></i>PRODUCTO NO VIABLE`;
                badge.className = "badge bg-danger";
                badge.innerText = "Rechazado (RN06)";
                
                profitText.className = "fw-bold fs-4 text-danger";
                marginText.className = "fw-bold fs-4 text-danger";
                
                const loss = sellVal - costVal;
                profitText.innerText = `$${loss.toFixed(2)}`;
                marginText.innerText = "0.00%";
            } else {
                // Valid margin
                resultBox.className = "p-3 rounded bg-success bg-opacity-10 border border-success border-opacity-20 mb-0";
                statusText.innerHTML = `<i class="bi bi-check-circle-fill me-2 text-success"></i>PRODUCTO VIABLE`;
                badge.className = "badge bg-success";
                badge.innerText = "Aprobado (RN06)";
                
                profitText.className = "fw-bold fs-4 text-success";
                marginText.className = "fw-bold fs-4 text-success";
                
                const profit = sellVal - costVal;
                const margin = (profit / sellVal) * 100;
                
                profitText.innerText = `$${profit.toFixed(2)}`;
                marginText.innerText = `${margin.toFixed(2)}%`;
            }
        }
    </script>
</body>
</html>
