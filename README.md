# 🌐 Sistem Kerja Praktek - Laravel Web Application

Selamat datang di repositori proyek Sistem Kerja Praktek. Proyek ini dibangun menggunakan framework **Laravel** sebagai fondasi pengembangan aplikasi web yang modern, efisien, dan terstruktur.

---

## 📋 Deskripsi Sistem

Aplikasi ini dikembangkan sebagai bagian dari kegiatan kerja praktek. Tujuan utamanya adalah membangun sistem berbasis web yang dapat digunakan untuk berbagai keperluan, seperti manajemen data internal, administrasi dokumen, atau layanan informasi publik berbasis digital.

---

## 📁 Struktur Folder / Proyek Laravel

Berikut adalah penjelasan singkat mengenai struktur folder dalam proyek ini:

| 📂 Folder / File         | 📖 Fungsi Utama |
|--------------------------|----------------|
| `app/`                   | Berisi file logika aplikasi: controller, model, dan lainnya. |
| `bootstrap/`             | Menginisialisasi aplikasi Laravel. |
| `config/`                | Konfigurasi sistem seperti database, mail, cache, dsb. |
| `database/`              | Menyimpan migration, seeder, dan factory untuk database. |
| `lang/`                  | File terjemahan bahasa (lokalisasi). |
| `public/`                | Akses publik aplikasi, berisi file frontend dan `index.php`. |
| `resources/`             | Template tampilan (Blade), file Vue/JS, dan style CSS. |
| `routes/`                | Mendefinisikan rute-rute (routing) aplikasi (`web.php`, `api.php`). |
| `storage/`               | File hasil upload, log, cache, dsb. |
| `tests/`                 | Unit test dan feature test Laravel. |
| `composer.json`          | File dependensi PHP menggunakan Composer. |
| `package.json`           | File dependensi frontend menggunakan npm. |
| `vite.config.js`         | Konfigurasi Vite sebagai bundler frontend. |
| `tailwind.config.js`     | Konfigurasi untuk Tailwind CSS. |

---

## 🛠️ Teknologi yang Digunakan

- **Laravel** 10+
- **PHP** 8.1+
- **Composer**
- **Node.js** dan **npm**
- **Vite**
- **Tailwind CSS**
- **PostCSS**
- **MySQL** / **MariaDB**
- **Git**

---

## 🚀 Langkah Instalasi Cepat

Berikut adalah langkah singkat untuk menjalankan proyek ini di lokal Anda:

```bash
# 1. Clone repository ini
git clone https://github.com/username/repo-name.git
cd repo-name

# 2. Install dependency PHP
composer install

# 3. Install dependency JavaScript
npm install

# 4. Duplikasi file environment
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Jalankan migrasi database (jika diperlukan)
php artisan migrate

# 7. Jalankan server lokal Laravel
php artisan serve

# 8. Jalankan vite untuk assets frontend
npm run dev
