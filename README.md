# 🚨 Sistem Administrasi Pengajuan Anggaran | Polda Jawa Timur

Aplikasi berbasis Laravel yang dirancang khusus untuk mendigitalisasi proses pengajuan anggaran dari Polsek ke Polres hingga Polda Jatim. Fokus pada **efisiensi, transparansi, dan akuntabilitas** dalam tata kelola anggaran publik.

---

## 📌 Daftar Isi

- [🔍 Tentang Proyek](#-tentang-proyek)
- [✨ Fitur Unggulan](#-fitur-unggulan)
- [🛠️ Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [🚀 Panduan Instalasi](#-panduan-instalasi)
- [🧪 Akun Super Admin](#-akun-super-admin)
- [📸 Tampilan Antarmuka](#-tampilan-antarmuka)
- [🤝 Kontribusi & Lisensi](#-kontribusi--lisensi)

---

## 🔍 Tentang Proyek

Proyek ini merupakan sistem manajemen anggaran berbasis web untuk lingkungan **Polda Jawa Timur**, dengan model **multi-role hierarchy**. Sistem ini menggantikan proses manual dengan alur kerja digital yang **tertata**, **terstruktur**, dan **berbasis notifikasi real-time**.

---

## ✨ Fitur Unggulan

### 🔐 1. Struktur Peran (Role-Based Access Control)

- **Super Admin (Polda)**: Akses penuh ke semua wilayah.
- **Admin (Polres)**: Kelola data & user dari wilayahnya sendiri.
- **User (Polsek)**: Input dan lacak status pengajuan anggaran.

### 📝 2. Alur Pengajuan Digital

- Form input dengan **upload 2 dokumen PDF wajib**.
- Sistem **Pagu Anggaran** per-Polsek yang otomatis terpotong saat disetujui.

### 🔔 3. Notifikasi Real-Time

- Ikon notifikasi (🔔) di dashboard.
- Notifikasi email otomatis untuk setiap update status.
- Fitur **respon cepat**: balasan dari admin dengan pesan kustom, template, atau lampiran.

### 🧩 4. CMS Dinamis (Content Management System)

- Kelola tampilan publik langsung dari admin panel tanpa coding.
- Kontrol penuh atas slider, footer, konten informasi, link eksternal, dan peta.

### 🧠 5. Otomatisasi Scheduler

- Sistem otomatis mengirim **pengingat pengajuan** dan memblokir user yang tidak aktif tepat waktu.

### 🗺️ 6. Peta Interaktif

- Pencarian lokasi kantor polisi berbasis **Leaflet.js**, langsung dari dashboard publik.

### 🎨 7. Desain Modern & Responsif

- Konsistensi UI/UX across devices.
- Dark/light mode friendly *(jika diaktifkan nanti)*.

---

## 🛠️ Teknologi yang Digunakan

| Layer        | Teknologi                              |
|--------------|-----------------------------------------|
| **Backend**  | Laravel 10, PHP 8.2                     |
| **Frontend** | Blade, Tailwind CSS, Alpine.js          |
| **Database** | MySQL                                   |
| **Library**  | Leaflet.js (Maps), Swiper.js (Slider), Cleave.js (Formatting) |

---

## 🚀 Panduan Instalasi

### 📁 1. Clone atau Ekstrak Proyek
```bash
git clone https://github.com/[USERNAME]/nama-proyek.git
cd nama-proyek

⚙️ 2. Konfigurasi .env

cp .env.example .env

Ubah:
	•	DB_DATABASE, DB_USERNAME, DB_PASSWORD
	•	MAIL_ konfigurasi jika ingin notifikasi email aktif

🧬 3. Import Database
	•	Buat database baru via phpMyAdmin atau CLI
	•	Import file .sql yang telah disediakan (misal: database/polda_jatim.sql)

📦 4. Instalasi Dependensi

composer install
npm install
php artisan key:generate
php artisan storage:link

▶️ 5. Jalankan Aplikasi

npm run dev
php artisan serve

🧑‍💼 6. Akun Super Admin Pertama
	•	Akses: http://127.0.0.1:8000
	•	Pendaftar pertama otomatis menjadi Super Admin

⸻
