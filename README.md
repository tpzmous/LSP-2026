# 🌐 N-COMICS — Platform Komik Online Berbasis PHP (CRUD)

## 👤 Profil Mahasiswa

| Field     | Detail                   |
|-----------|--------------------------|
| **Nama**  | Aditya Renanda Widyatama |
| **NIM**   | 202121420007             |
| **GitHub**| [@tpzmous](https://github.com/tpzmous) |

---

## 📖 Tentang Proyek

**N-COMICS** adalah aplikasi web berbasis **PHP dengan framework Laravel** yang menerapkan konsep **CRUD (Create, Read, Update, Delete)** secara penuh pada manajemen data komik dan episode.

Proyek ini dikembangkan sebagai platform membaca komik online bergaya modern dengan dua sisi:
- **Panel Admin** — untuk mengelola data komik dan episode (CRUD)
- **Halaman Publik** — untuk pengunjung membaca komik

---

## 🔄 Implementasi CRUD

### 📚 Manajemen Komik
| Operasi  | Deskripsi                                              |
|----------|--------------------------------------------------------|
| **Create** | Admin dapat menambahkan komik baru beserta cover, genre, author, dan deskripsi |
| **Read**   | Daftar komik ditampilkan di panel admin maupun halaman publik dengan filter & pencarian |
| **Update** | Admin dapat mengubah detail komik dan mengganti gambar cover |
| **Delete** | Admin dapat menghapus komik beserta episode-episodenya |

### 📄 Manajemen Episode
| Operasi  | Deskripsi                                              |
|----------|--------------------------------------------------------|
| **Create** | Admin dapat mengunggah episode baru dalam format PDF |
| **Read**   | Episode ditampilkan secara berurutan dan dapat dibaca oleh pengunjung |
| **Update** | Admin dapat mengganti judul dan file PDF episode |
| **Delete** | Admin dapat menghapus episode dari komik tertentu |

---

## 🛠 Teknologi yang Digunakan

| Teknologi     | Keterangan                                 |
|---------------|--------------------------------------------|
| PHP 8.2       | Bahasa pemrograman utama                   |
| Laravel 12    | Framework PHP (MVC Architecture)           |
| MySQL         | Database relasional                        |
| Tailwind CSS  | Framework CSS untuk tampilan modern        |
| Vite          | Bundler frontend                           |
| PDF.js        | Render file PDF langsung di browser        |
| Blade         | Template engine bawaan Laravel             |

---

## 💻 Kebutuhan Sistem

Pastikan komputer sudah terinstall:

- **PHP** >= 8.2
- **Composer** v2+
- **Node.js** v18+ & **NPM**
- **MySQL** (XAMPP / Laragon / standalone)

---

## 🚀 Cara Instalasi (Windows)

### Langkah 1 — Siapkan Database
Buat database kosong di MySQL dengan nama `comic_platform`:
```sql
CREATE DATABASE comic_platform;
```

### Langkah 2 — Jalankan Installer
Klik dua kali file **`install.bat`** di folder proyek.

Script akan otomatis melakukan:
1. Install dependensi PHP (`composer install`)
2. Salin file `.env.example` → `.env`
3. Generate Laravel App Key
4. Buat symlink storage publik
5. Buat folder storage (covers, episodes, comics)
6. Jalankan migrasi & seeder (10 komik dummy + akun admin)
7. Install NPM & compile aset frontend
8. Bersihkan cache

### Langkah 3 — Jalankan Server
Klik dua kali **`start.bat`**, lalu buka browser:

```
http://127.0.0.1:8000
```

---

## 🔒 Akun Admin Default

| Field        | Value              |
|--------------|--------------------|
| **Email**    | admin@ncomics.com  |
| **Password** | admin123           |
| **Role**     | Administrator      |

> Akun pengguna biasa **hanya bisa dibuat oleh admin**. Tidak ada fitur registrasi publik.

---

## ✨ Fitur Unggulan

- ✅ CRUD Komik & Episode dengan upload gambar dan PDF
- ✅ Panel admin yang lengkap dan responsif
- ✅ Reader PDF vertikal tanpa batas halaman
- ✅ Filter genre, pencarian judul, dan pengurutan komik
- ✅ Tema dark mode modern dengan aksen neon cyan
- ✅ 10 data dummy komik tersedia otomatis setelah instalasi
- ✅ Manajemen akun user oleh admin

---

*Dibuat untuk keperluan ujian kompetensi LSP 2026*
