<?php
session_start();
require_once "../config/database.php";

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: ../dashboard/index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi.";
    } else {
        $sql  = "SELECT * FROM admins WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["email" => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin["password"])) {
            // Regenerate session ID untuk keamanan
            session_regenerate_id(true);

            $_SESSION["admin_id"]    = $admin["id"];
            $_SESSION["admin_name"]  = $admin["name"];
            $_SESSION["admin_email"] = $admin["email"];

            header("Location: ../dashboard/index.php");
            exit;
        } else {
            $error = "Email atau password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="login-container">

    <div class="brand-side">
        <div class="brand-content">
            <div class="brand-logo">◆</div>
            <h1>Admin Panel</h1>
            <p>Kelola sistem Anda dengan mudah, cepat, dan aman melalui satu dashboard terpusat.</p>
            <ul class="brand-points">
                <li><span>✓</span> Autentikasi aman dengan hashing password</li>
                <li><span>✓</span> Session management terenkripsi</li>
                <li><span>✓</span> Dashboard responsif di semua perangkat</li>
            </ul>
        </div>
    </div>

    <div class="form-side">
        <div class="login-card">

            <div class="login-header">
                <div class="admin-icon">👤</div>
                <h2>Selamat Datang</h2>
                <p>Masuk untuk melanjutkan ke dashboard</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert-error">
                    <span>⚠</span> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" autocomplete="off">

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">✉</span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@email.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper password-wrapper">
                        <span class="input-icon">🔒</span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >
                        <button
                            type="button"
                            class="toggle-password"
                            id="togglePassword"
                            aria-label="Tampilkan password"
                        >👁</button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    Masuk <span class="btn-arrow">→</span>
                </button>

            </form>

            <p class="login-footer">Akun demo: admin@gmail.com / admin123</p>
        </div>
    </div>

</div>

<script src="../assets/js/login.js"></script>
</body>
</html>
