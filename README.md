# 💊 Obatku - Sistem Manajemen Farmasi & Resep Digital

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

**Obatku** adalah platform kesehatan digital terpadu yang dibangun untuk mengotomatisasi dan menjembatani alur kerja fasilitas kesehatan. Sistem ini merampingkan proses dari ruang periksa dokter, manajemen inventaris di apotek, hingga memastikan kepatuhan jadwal minum obat oleh pasien.

---

## ✨ Fitur Unggulan

Aplikasi ini menggunakan arsitektur berbasis peran (*Role-Based Access Control*) dengan 3 aktor utama:

### 👨‍⚕️ 1. Panel Dokter
* **Manajemen Pasien & Rekam Medis:** Pencatatan diagnosa dan riwayat pemeriksaan pasien.
* **E-Resep Terintegrasi:** Pembuatan resep elektronik langsung dari form rekam medis pasien.
* **Antrean Real-Time:** Memantau jumlah antrean pasien periksa secara aktual.

### 👩‍🔬 2. Panel Apoteker
* **Validasi E-Resep:** Menerima resep dari dokter dan memprosesnya menjadi antrean pengambilan obat.
* **Smart Inventory System:** Pengurangan stok otomatis berdasarkan jumlah satuan obat yang diresepkan.
* **Manajemen Obat:** Pencatatan master data obat, satuan, tanggal kedaluwarsa, dan peringatan stok menipis.

### 🧑‍🦽 3. Panel Pasien
* **Jadwal Minum Obat Dinamis:** Timeline interaktif (Pagi, Siang, Malam) yang beradaptasi dengan waktu saat ini. Dilengkapi animasi pengingat dan pengunci tombol cerdas.
* **Log Kepatuhan:** Fitur pencatatan harian untuk memantau kelancaran konsumsi obat (Tepat Waktu / Terlewati).
* **Riwayat Medis:** Akses unduh E-Resep dalam format PDF.

---

## 🛠️ Prasyarat Sistem

Sebelum menjalankan aplikasi ini, pastikan sistem Anda telah terinstal:
* **PHP** >= 8.2
* **Composer** >= 2.0
* **MySQL** atau MariaDB
* **Node.js** & **NPM** (Opsional, untuk kompilasi aset jika diperlukan)

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan **Obatku** di mesin lokal Anda:

1. **Clone Repository**
   > git clone https://github.com/username/obatku.git
   > cd obatku

2. **Install Dependensi Node**
   > npm install

3. **Install Dependensi PHP**
   > composer install

4. **Konfigurasi Environment**
   Salin file konfigurasi bawaan dan sesuaikan dengan database Anda:
   > cp .env.example .env
   
   Buka file `.env` dan atur koneksi database:
   > DB_CONNECTION=mysql
   > DB_HOST=127.0.0.1
   > DB_PORT=3306
   > DB_DATABASE=db_obatku
   > DB_USERNAME=root
   > DB_PASSWORD=

5. **Generate Application Key**
   > php artisan key:generate

6. **Migrasi Database & Seeder**
   Jalankan perintah ini untuk membangun struktur tabel beserta data contoh (*dummy data*):
   > php artisan migrate --seed

7. **Jalankan Server Lokal**
   > php artisan serve

   Aplikasi kini dapat diakses melalui browser di: `http://127.0.0.1:8000`

---

## ⚙️ Konfigurasi Penting (Zona Waktu)
Sistem jadwal obat sangat bergantung pada keakuratan waktu. Pastikan Anda telah mengatur *timezone* aplikasi ke waktu lokal Indonesia.
Buka file `config/app.php` dan ubah:
> 'timezone' => 'Asia/Jakarta',

---

## 🔒 Custom Artisan Command
Aplikasi ini dilengkapi dengan *command* khusus untuk membuat akun Super Admin langsung dari terminal (sangat berguna untuk *deployment* di cloud):
> php artisan make:admin nama@email.com rahasia123 "Nama Admin"

---

## 👨‍💻 Pengembang
Dikembangkan untuk memberikan solusi digitalisasi pada sektor klinik dan apotek.

**© 2026 Obatku.** Membangun Ekosistem Kesehatan Digital Indonesia.
## 💻 Demo

https://laravel-project-main-xucq4b.free.laravel.cloud/
