<?php
// Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if it is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    require_once dirname(__DIR__, 2) . '/config/database.php';

    // Retrieve input values and sanitize them
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $roleName = $_POST['role'] ?? 'Cliente';

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: register.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "El formato de correo electrónico no es válido.";
        header("Location: register.php");
        exit;
    }

    // Map role name to id_rol
    $id_rol = 3; // Default to Cliente
    if ($roleName === 'Administrador' || $roleName === 'admin') {
        $id_rol = 1;
    } elseif ($roleName === 'Vendedor') {
        $id_rol = 2;
    }

    // Check if email already exists
    $stmt = $con->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = "El correo electrónico ya está registrado.";
            $stmt->close();
            header("Location: register.php");
            exit;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error en el sistema al validar el correo.";
        header("Location: register.php");
        exit;
    }

    // Hash the password using BCRYPT (as required by RNF01)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $stmt = $con->prepare("INSERT INTO usuarios (usuario, email, password, id_rol, estado, fecha_creacion) VALUES (?, ?, ?, ?, 1, NOW())");
    if ($stmt) {
        $stmt->bind_param("sssi", $name, $email, $hashed_password, $id_rol);
        if ($stmt->execute()) {
            $_SESSION['success'] = "¡Registro exitoso! Ya puedes iniciar sesión.";
            $stmt->close();
            header("Location: login.php");
            exit;
        } else {
            $_SESSION['error'] = "Error al registrar el usuario: " . $stmt->error;
            $stmt->close();
            header("Location: register.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Error en el sistema al preparar el registro.";
        header("Location: register.php");
        exit;
    }
} else {
    // If not POST, redirect to register page
    header("Location: register.php");
    exit;
}
?>
