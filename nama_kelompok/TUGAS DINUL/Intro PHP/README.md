## 🐾 Sistem Adopsi Hewan (Cat Adoption Web App)

Proyek ini adalah aplikasi web sederhana untuk mengelola data adopsi hewan menggunakan **PHP**, **MySQL**, dan **Tailwind CSS**. Aplikasi ini memungkinkan pengguna untuk mengisi formulir adopsi dan melihat data adopsi yang telah tersimpan.

### 🔧 Fitur:

* Form input adopsi hewan
* Tampilan data adopsi dalam tabel
* Menu navigasi antar halaman
* Desain modern dengan Tailwind CSS
* Koneksi database MySQL via PHP (MySQLi)


### 📁 Struktur Folder:

```
/adopsi-hewan/
│
├── index.html               → Halaman menu utama
├── form_adoption.html       → Formulir pengisian data adopsi
├── simpan_adoption.php      → Menyimpan data ke database
├── tampil_adoption.php      → Menampilkan data adopsi
├── database/
│   └── cat_adoption.sql     → (Opsional) file backup database
└── README.md                → Dokumentasi proyek
```


### 🗃️ Struktur Tabel `adoption`

| Kolom          | Tipe Data    | Keterangan                  |
| -------------- | ------------ | --------------------------- |
| `id_adop`      | INT (PK, AI) | ID unik, auto increment     |
| `nama_adopter` | VARCHAR      | Nama pengadopsi             |
| `jenis_hewan`  | VARCHAR      | Jenis hewan yang diadopsi   |
| `tanggal`      | DATE         | Tanggal adopsi dilakukan    |
| `notes`        | TEXT         | Catatan tambahan (opsional) |


### 🛠️ Cara Menjalankan Proyek:

1. **Clone / Salin folder ke direktori Laragon/XAMPP:**

   ```
   C:\laragon\www\adopsi-hewan\
   ```

2. **Jalankan Laragon / XAMPP dan aktifkan Apache + MySQL**

3. **Buat database:**

   * Nama database: `cat adoption`
   * Import file `cat_adoption.sql` dari folder `database/` *(jika disediakan)*
     Atau buat manual di phpMyAdmin dengan tabel `adoption`

4. **Akses di browser:**

   ```
   http://localhost/adopsi-hewan/index.html
   ```
===============================================================

### 💡 Catatan Tambahan:

* Username database: `root`
* Password: *(kosong jika Laragon default)*

