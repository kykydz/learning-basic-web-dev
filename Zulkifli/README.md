# Panduan Menggunakan GitHub

## 1. Membuat Akun GitHub
1. Buka [github.com](https://github.com).
2. Klik **Sign up** dan ikuti langkah-langkah pendaftaran.

## 2. Membuat Repository Baru
1. Login ke GitHub.
2. Klik ikon **+** di kanan atas, pilih **New repository**.
3. Isi nama repository, deskripsi (opsional), dan atur visibilitas.
4. Klik **Create repository**.

## 3. Menginstal Git
- Unduh dan instal Git dari [git-scm.com](https://git-scm.com/).

## 4. Menghubungkan Repository Lokal ke GitHub
```bash
git init
git remote add origin https://github.com/username/nama-repo.git
```

## 5. Membuat dan Berpindah Branch
```bash
git checkout -b nama-branch
```
Untuk berpindah ke branch lain:
```bash
git checkout nama-branch
```

## 6. Menambahkan, Commit, dan Push Perubahan ke Branch
```bash
git add .
git commit -m "Pesan commit"
git push -u origin nama-branch
```

## 7. Menarik (Pull) Perubahan dari Branch di GitHub
```bash
git pull origin nama-branch
```

## 8. Clone Repository
```bash
git clone https://github.com/username/nama-repo.git
```

## 9. Sumber Belajar
- [GitHub Docs](https://docs.github.com/)
- [Git Handbook](https://guides.github.com/introduction/git-handbook/)

---
**Catatan:** Ganti `username`, `nama-repo`, dan `nama-branch` sesuai akun, repository, dan branch Anda.