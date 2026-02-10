# Akun Admin yang Telah Dibuat

Berikut adalah daftar akun yang telah dibuat melalui seeder:

## 🔴 Admin Utama (Main Admin)
| Field | Value |
|-------|-------|
| Nama | Administrator Utama |
| Email | `admin@localhost` |
| Password | `admin123` |
| Status | ✅ Disetujui (Approved) |
| Role | 👑 Admin Utama (Main Admin) |

## 🟡 Admin Secondary
| Field | Value |
|-------|-------|
| Nama | Admin Secondary |
| Email | `admin@gmail.com` |
| Password | `password` |
| Status | ✅ Disetujui (Approved) |
| Role | 👑 Admin Utama (Main Admin) |

## 🟢 Test User
| Field | Value |
|-------|-------|
| Nama | Test User |
| Email | `test@example.com` |
| Password | `password` |
| Status | ✅ Disetujui (Approved) |
| Role | 👤 Regular User |

---

## 📝 Cara Login

1. Buka aplikasi di browser: `http://localhost:8000`
2. Klik menu "Login"
3. Masukkan email dan password dari akun yang ingin digunakan
4. Klik tombol "Login"

## ⚙️ Cara Menambah Akun Baru

Jika ingin menambah akun baru dengan seeder, edit file:
```
database/seeders/UserSeeder.php
```

Tambahkan kode berikut di dalam method `run()`:
```php
// Contoh: Tambah user baru
if (!User::where('email', 'nama@example.com')->exists()) {
    User::create([
        'name' => 'Nama User',
        'email' => 'nama@example.com',
        'password' => bcrypt('password123'),
        'daerah_id' => null,
        'is_approved' => true,
        'is_main_admin' => false,
        'is_rejected' => false,
    ]);
    $this->command->info('✅ User Baru berhasil dibuat!');
}
```

Kemudian jalankan:
```bash
php artisan db:seed --class=UserSeeder
```
