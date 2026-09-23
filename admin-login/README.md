# Admin Panel — Sistem Login & Logout

Sistem autentikasi admin sederhana menggunakan PHP native (PDO) + MySQL, dengan desain login split-screen dan dashboard modern.

## 🗂 Struktur Project

```
admin-login/
├── config/
│   └── database.php      # Koneksi PDO ke MySQL
├── auth/
│   ├── login.php          # Halaman & proses login
│   └── logout.php         # Proses logout (hancurkan session)
├── dashboard/
│   └── index.php          # Halaman setelah login berhasil
├── assets/
│   ├── css/style.css      # Styling (login + dashboard)
│   └── js/login.js        # Toggle show/hide password
├── database.sql           # Skema database & tabel admins
├── create_admin.php       # Script sekali-jalan buat admin pertama
└── index.php               # Router awal (redirect login/dashboard)
```

## ⚙️ Instalasi

### 1. Ekstrak project
Ekstrak folder `admin-login/` ke dalam:
- **XAMPP** → `C:\xampp\htdocs\`
- **Laragon** → `C:\laragon\www\`
- **MAMP** → `htdocs/`

Sehingga bisa diakses lewat `http://localhost/admin-login/`.

### 2. Buat database
Buka **phpMyAdmin**, lalu:
- Buat database baru, atau langsung import file `database.sql` (Import → pilih file → Go).
- Ini akan otomatis membuat database `db_admin` dan tabel `admins`.

### 3. Cek koneksi database
Buka `config/database.php`, sesuaikan kalau perlu:

```php
$host     = "localhost";
$dbname   = "db_admin";
$username = "root";
$password = "";   // isi jika MySQL kamu pakai password
```

### 4. Buat akun admin pertama
Jalankan di browser:

```
http://localhost/admin-login/create_admin.php
```

Akun default yang dibuat:

| Email             | Password  |
|-------------------|-----------|
| admin@gmail.com   | admin123  |

Jika berhasil akan muncul pesan **"Admin berhasil dibuat."**

> ⚠️ **Penting:** setelah admin berhasil dibuat, **hapus file `create_admin.php`** dari server. File ini hanya untuk keperluan setup awal dan tidak boleh diakses publik karena berisi password default dalam bentuk teks biasa.

### 5. Jalankan aplikasi
Buka:

```
http://localhost/admin-login/
```

Kamu akan diarahkan otomatis ke halaman login.

## 🔐 Alur Autentikasi

- **Login** (`auth/login.php`): validasi input → cek email di database → `password_verify()` terhadap hash → jika cocok, `session_regenerate_id()` lalu simpan `admin_id`, `admin_name`, `admin_email` ke `$_SESSION`.
- **Proteksi dashboard** (`dashboard/index.php`): mengecek `$_SESSION['admin_id']`; jika tidak ada, redirect balik ke login.
- **Logout** (`auth/logout.php`): mengosongkan `$_SESSION`, menghapus cookie session, lalu `session_destroy()`.

## 🛠 Menambah Admin Baru

Cara paling aman: tambahkan lewat query manual di phpMyAdmin dengan password yang sudah di-hash, misalnya lewat file sementara seperti `create_admin.php` (ubah `$name`, `$email`, `$password`, jalankan sekali, lalu hapus lagi).

Jangan pernah menyimpan password asli (plain text) langsung ke kolom `password` di database — selalu lewat `password_hash()`.

## 🧩 Requirement

- PHP 7.4+ (disarankan PHP 8.x)
- MySQL / MariaDB
- Ekstensi PHP: `pdo_mysql`

## 🎨 Kustomisasi Tampilan

Semua styling ada di satu file: `assets/css/style.css`, dibagi jadi 2 bagian:
- `LOGIN` — halaman login split-screen
- `DASHBOARD` — navbar, kartu info, welcome banner

Warna utama (ungu-indigo gradient) bisa diganti di beberapa tempat yang memakai:
```css
linear-gradient(135deg, #4338ca, #7c3aed)
```
