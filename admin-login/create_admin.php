<?php
require_once "config/database.php";

$name     = "Administrator";
$email    = "admin@gmail.com";
$password = "admin123";

// Membuat password hash
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Cek dulu apakah email sudah terdaftar (biar tidak error UNIQUE constraint)
$check = $pdo->prepare("SELECT id FROM admins WHERE email = :email");
$check->execute(["email" => $email]);

if ($check->fetch()) {
    echo "Admin dengan email ini sudah ada. Tidak perlu dibuat ulang.";
    exit;
}

// Masukkan ke database
$sql = "INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    "name"     => $name,
    "email"    => $email,
    "password" => $passwordHash
]);

echo "Admin berhasil dibuat.<br>";
echo "Email: " . htmlspecialchars($email) . "<br>";
echo "Password: " . htmlspecialchars($password) . "<br><br>";
echo "<strong>PENTING:</strong> Hapus file create_admin.php ini setelah selesai digunakan, demi keamanan.";
