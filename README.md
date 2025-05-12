# 🦷 Dentist Appointment System - Laravel Web Application

Selamat datang di **Dentist Appointment System**, sebuah aplikasi web yang dibangun menggunakan framework **Laravel**. Sistem ini dirancang untuk memudahkan proses penjadwalan janji temu dengan dokter gigi dan memperkuat komunikasi antara pengguna dan administrator.

---

## 📋 Deskripsi Sistem

**Dentist Appointment System** memungkinkan pengguna untuk:

- Menjadwalkan janji temu dengan dokter gigi secara online.
- Memberikan masukan atau feedback setelah layanan.

Sementara itu, **administrator** dapat:

- Mengelola dan memantau janji temu yang masuk.
- Mengevaluasi masukan dari pengguna.
- Menganalisis data dan tren layanan melalui dasbor khusus.

Platform ini bertujuan untuk menyederhanakan pengelolaan janji temu, meningkatkan pengalaman pasien, dan mempercepat alur komunikasi antara pengguna dan penyedia layanan.

---

## 📁 Struktur Folder / Proyek Laravel

| 📂 Folder / File         | 📖 Fungsi Utama |
|--------------------------|----------------|
| `app/`                   | Logika aplikasi seperti controller, model, middleware. |
| `bootstrap/`             | Proses inisialisasi aplikasi. |
| `config/`                | File konfigurasi (database, mail, session, dsb). |
| `database/`              | Migrasi, seeder, dan factory database. |
| `lang/`                  | File bahasa (lokalisasi). |
| `public/`                | File yang diakses publik termasuk `index.php`. |
| `resources/`             | Tampilan frontend (Blade), JS, dan style. |
| `routes/`                | Routing aplikasi Laravel (`web.php`, `api.php`). |
| `storage/`               | Penyimpanan file, log, cache, dan upload. |
| `tests/`                 | Pengujian unit dan fitur. |
| `vite.config.js`         | Konfigurasi bundler Vite untuk asset frontend. |

---

## 🛠️ Teknologi yang Digunakan

- **Laravel** 10+
- **PHP** 8.1+
- **Composer** (dependency PHP)
- **Node.js** dan **npm** (dependency frontend)
- **Vite** (asset bundler)
- **Tailwind CSS** (utility-first CSS framework)
- **PostCSS**
- **MySQL** / **MariaDB**
- **Git**

---

## 🚀 Langkah Instalasi Cepat

Ikuti langkah berikut untuk menjalankan proyek secara lokal:

```bash
# 1. Clone repository ini
git clone https://github.com/username/dentist-appointment-system.git
cd dentist-appointment-system

# 2. Install dependency PHP
composer install

# 3. Install dependency JavaScript
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Atur koneksi database di file .env

# 7. Jalankan migrasi database
php artisan migrate

# 8. Jalankan server Laravel
php artisan serve

# 9. Jalankan Vite untuk frontend
npm run dev
