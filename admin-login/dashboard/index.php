<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION["admin_id"])) {
    header("Location: ../auth/login.php");
    exit;
}

$adminName  = $_SESSION["admin_name"];
$adminEmail = $_SESSION["admin_email"];
$initial    = strtoupper(substr($adminName, 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="dashboard-container">

    <nav class="navbar">
        <div class="navbar-brand">
            <span class="brand-logo-small">◆</span>
            <h2>Admin Panel</h2>
        </div>
        <div class="navbar-user">
            <div class="user-chip">
                <span class="user-avatar"><?= htmlspecialchars($initial) ?></span>
                <span class="user-name"><?= htmlspecialchars($adminName) ?></span>
            </div>
            <a href="../auth/logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>

    <main class="dashboard-content">

        <div class="welcome-banner">
            <div class="welcome-avatar"><?= htmlspecialchars($initial) ?></div>
            <div>
                <h1>Selamat Datang, <?= htmlspecialchars($adminName) ?>!</h1>
                <p>Anda berhasil login ke dalam sistem administrator.</p>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <span class="info-label">Nama</span>
                <span class="info-value"><?= htmlspecialchars($adminName) ?></span>
            </div>
            <div class="info-card">
                <span class="info-label">Email</span>
                <span class="info-value"><?= htmlspecialchars($adminEmail) ?></span>
            </div>
            <div class="info-card">
                <span class="info-label">Status</span>
                <span class="status-badge">● Aktif</span>
            </div>
        </div>

    </main>
</div>

</body>
</html>
