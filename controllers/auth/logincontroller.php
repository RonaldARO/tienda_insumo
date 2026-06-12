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
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $roleName = $_POST['role'] ?? 'Cliente';

    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: login.php");
        exit;
    }

    // Map role name to id_rol
    $id_rol = 3; // Default to Cliente
    if ($roleName === 'Administrador' || $roleName === 'admin') {
        $id_rol = 1;
    } elseif ($roleName === 'Vendedor') {
        $id_rol = 2;
    }

    // Retrieve user by email and id_rol
    $stmt = $con->prepare("SELECT id_usuario, usuario, password, estado FROM usuarios WHERE email = ? AND id_rol = ?");
    if ($stmt) {
        $stmt->bind_param("si", $email, $id_rol);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id_usuario, $username, $hashed_password, $estado);
            $stmt->fetch();
            
            // Check status/estado
            if ($estado != 1) {
                $_SESSION['error'] = "Tu cuenta está desactivada.";
                $stmt->close();
                header("Location: login.php");
                exit;
            }

            // Verify password using password_verify (for BCRYPT)
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $id_usuario;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role_id'] = $id_rol;
                $_SESSION['role_name'] = $roleName;
                $_SESSION['last_activity'] = time(); // for RNF01 session timeout

                $_SESSION['success_login'] = "¡Acceso autorizado! Bienvenido, " . htmlspecialchars($username);
                $stmt->close();
                
                // Redirect to dashboard (Public/index.php)
                header("Location: ../../Public/index.php");
                exit;
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
                $stmt->close();
                header("Location: login.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "No se encontró ningún usuario registrado con ese correo y rol.";
            $stmt->close();
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Error en el sistema al procesar el inicio de sesión.";
        header("Location: login.php");
        exit;
    }
} else {
    // If not POST, redirect to login page
    header("Location: login.php");
    exit;
}
?>
