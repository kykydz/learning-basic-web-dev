## 🐾 Sistem Adopsi Hewan (Cat Adoption Web App)

Proyek ini adalah aplikasi web sederhana untuk mengelola data adopsi hewan menggunakan **HTML**, **PHP**, **MySQL**, dan **Tailwind CSS**. Aplikasi ini memungkinkan pengguna untuk menginput, melihat, mengubah, dan menghapus data adopsi secara mudah melalui antarmuka web.

---

### 🔧 Fitur:

* Input data adopsi hewan
* Menampilkan semua data adopsi
* Edit (ubah) data adopsi
* Hapus data adopsi dengan konfirmasi
* Navigasi antar halaman (menu utama)
* Desain modern dan responsif dengan Tailwind CSS
* Koneksi ke MySQL menggunakan MySQLi

---

### 📁 Struktur Folder:

```
/adopsi-hewan/
│
├── index.html               → Halaman menu utama (navigasi)
├── form_adoption.html       → Formulir input data adopsi
├── simpan_adoption.php      → Proses simpan data ke database
├── tampil_adoption.php      → Menampilkan semua data + tombol edit/hapus
├── edit_adoption.php        → Menampilkan form edit data
├── update_adoption.php      → Memproses update data ke database
├── hapus_adoption.php       → Menghapus data berdasarkan ID
├── koneksi.php              → File koneksi ke database
├── database/
│   └── cat_adoption.sql     → (Opsional) backup skema dan data awal
└── README.md                → Dokumentasi proyek
```

---

### 🗃️ Struktur Tabel `adoption` (MySQL)

| Kolom          | Tipe Data    | Keterangan                  |
| -------------- | ------------ | --------------------------- |
| `id_adop`      | INT (PK, AI) | ID unik, auto increment     |
| `nama_adopter` | VARCHAR      | Nama pengadopsi             |
| `jenis_hewan`  | VARCHAR      | Jenis hewan yang diadopsi   |
| `tanggal`      | DATE         | Tanggal adopsi              |
| `notes`        | TEXT         | Catatan tambahan (opsional) |

---

### 🛠️ Cara Menjalankan Proyek:

1. **Clone / Salin folder ke direktori Laragon atau XAMPP:**

   ```
   C:\laragon\www\adopsi-hewan\
   ```

2. **Aktifkan Apache dan MySQL melalui Laragon / XAMPP**

3. **Buat database baru:**

   * Nama database: `cat adoption`
   * Import file `cat_adoption.sql` dari folder `database/` *(jika disediakan)*
     atau buat tabel `adoption` secara manual di phpMyAdmin

4. **Akses aplikasi via browser:**

   ```
   http://localhost/adopsi-hewan/index.html
   ```

---

### 💡 Catatan Tambahan:

* Username database: `root`
* Password: *(kosong jika menggunakan Laragon default)*
* Disarankan menggunakan browser modern dan koneksi lokal aktif
* Semua halaman sudah didesain responsif menggunakan Tailwind CSS CDN
