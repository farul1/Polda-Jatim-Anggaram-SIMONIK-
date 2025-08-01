<h1 align="center">🚓 Sistem Administrasi Pengajuan Anggaran Polda Jatim</h1>

<p align="center">
  Aplikasi Web Laravel Modern untuk <strong>Pengelolaan Anggaran Polsek</strong> yang Transparan, Efisien, dan Akuntabel.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-red?style=for-the-badge&logo=laravel" alt="Laravel Badge">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php" alt="PHP Badge">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql" alt="MySQL Badge">
  <img src="https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind Badge">
</p>

---

## 📖 Tentang Proyek

Aplikasi ini dirancang untuk **memodernisasi sistem pengajuan anggaran** dari Polsek ke Polres dalam wilayah hukum **Polda Jawa Timur**. Berbasis Laravel, sistem ini menyederhanakan proses birokrasi, menghadirkan **notifikasi real-time**, dan menyediakan **dashboard manajemen modern**.

---

## ✨ Fitur Unggulan

### 🧑‍💼 Sistem Hirarki Peran
- **👑 Super Admin (Polda):** Akses dan kontrol penuh atas seluruh data dari semua wilayah.
- **🛡️ Admin (Polres):** Mengelola pengajuan dari Polsek di bawah wilayahnya.
- **👮 User (Polsek):** Mengajukan dan mengelola permintaan anggaran.

### 📂 Manajemen Pengajuan Anggaran
- Upload dua dokumen PDF per pengajuan.
- Pagu Anggaran per Polsek yang otomatis terpotong saat disetujui.

### 🔔 Sistem Notifikasi Canggih
- Notifikasi langsung di web (ikon lonceng) & email.
- Admin bisa membalas dengan pesan teks, template, bahkan gambar.

### 🧩 Content Management System (CMS)
- Admin dapat mengubah konten publik tanpa coding: slider, peta, footer, link, dll.

### ⏰ Otomatisasi Jadwal
- Email reminder otomatis untuk user yang belum mengajukan tepat waktu.
- Sistem dapat memblokir user dengan riwayat keterlambatan.

### 🗺️ Pencarian Lokasi Interaktif
- Integrasi **Leaflet.js** untuk memetakan data lokasi kantor Polsek & Polres.

### 🎨 Desain Elegan & Responsif
- Halaman publik, login, dan dashboard dirancang dengan tampilan modern & profesional.

---

## ⚙️ Teknologi yang Digunakan

| Teknologi      | Deskripsi                       |
|----------------|---------------------------------|
| Laravel 10     | Backend utama (PHP Framework)   |
| PHP 8.2        | Bahasa pemrograman server-side  |
| MySQL          | Database relasional             |
| Blade          | Templating engine Laravel       |
| Tailwind CSS   | Utility-first CSS framework     |
| Alpine.js      | Interaktivitas ringan di frontend |
| Swiper.js      | Carousel & slider gambar        |
| Leaflet.js     | Pemetaan interaktif lokasi      |
| Cleave.js      | Format angka dan nominal uang   |

---

## 🚀 Panduan Instalasi Lokal

```bash
# 1. Clone atau ekstrak proyek
git clone [URL_REPO_ANDA]
cd nama-folder-proyek

# 2. Konfigurasi .env
cp .env.example .env
# Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD, MAIL_*

# 3. Import Database
# Buat database di phpMyAdmin lalu import file .sql yang disediakan

# 4. Instal dependensi dan siapkan Laravel
composer install
npm install
php artisan key:generate
php artisan storage:link

# 5. Jalankan server
npm run dev      # Untuk asset frontend
php artisan serve # Untuk backend Laravel


⸻

🧪 Registrasi Super Admin Pertama

Buka browser ke http://127.0.0.1:8000, lalu buat akun baru.
Akun pertama yang dibuat akan otomatis menjadi Super Admin.

⸻

📸 Tampilan (Preview)

Login Page	Dashboard Admin	Halaman Peta
		


⸻

🧑‍💻 Developer

[NAMA ANDA]
Sistem Informasi - Telkom University Surabaya

Untuk pertanyaan, kolaborasi, atau laporan bug, silakan hubungi melalui [email@example.com] atau langsung buka Issues di repositori ini.

⸻

📜 Lisensi

Proyek ini dilisensikan di bawah MIT License.

⸻


---

### ✅ Catatan Tambahan:
- Gambar preview seperti `preview/login.png` dapat kamu ganti atau hapus jika belum tersedia.
- Jangan lupa ubah placeholder `[NAMA ANDA]`, `[URL_REPO_ANDA]`, dan `email@example.com`.
- Jika ingin menambahkan logo institusi atau badge CI/CD (misal GitHub Actions), tinggal tambahkan bagian `<img>` pada header atau footer.

Kalau kamu mau versi yang dark mode atau tambahan animasi (GIF loading, dashboard), tinggal kasih tahu saja. Mau dijadikan PDF juga bisa.
