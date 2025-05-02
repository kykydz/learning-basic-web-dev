
# 📂 Panduan Upload File ke GitHub Menggunakan Git Branch

Panduan ini menjelaskan langkah-langkah lengkap untuk mengunggah file ke GitHub menggunakan fitur **git branch**, termasuk membuat branch, push file, pull request, merge, hingga mengatasi konflik.

---

## 🛠️ Prasyarat

Pastikan:
- Sudah menginstal [Git](https://git-scm.com/)
- Memiliki akun GitHub dan repository
- Telah mengatur konfigurasi Git (jika belum):

```bash
git config --global user.name "Nama Anda"
git config --global user.email "email@anda.com"
```

---

## 🚀 Langkah Upload File via Git Branch

1. **Clone Repository GitHub**

```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```

2. **Buat Branch Baru**

```bash
git checkout -b nama-branch
```

> Contoh: `git checkout -b fitur-upload`

3. **Tambahkan File atau Modifikasi**

Letakkan file baru atau edit file yang ada dalam folder project.

4. **Tambahkan ke Staging Area**

```bash
git add .
```

> Atau `git add namafile.ext` untuk file tertentu.

5. **Commit Perubahan**

```bash
git commit -m "Menambahkan file upload"
```

6. **Push ke Remote Branch**

```bash
git push origin nama-branch
```

7. **Buat Pull Request (PR)**

- Buka repository GitHub.
- Klik tombol **Compare & pull request**.
- Isi deskripsi, lalu klik **Create pull request**.

---

## 🔀 Merge Branch ke Main (Opsional)

**A. Via GitHub**
- Buka PR, klik **Merge pull request**.

**B. Via Command Line**

```bash
git checkout main
git pull origin main
git merge nama-branch
git push origin main
```

---

## ⚠️ Mengatasi Konflik Merge

Jika terjadi konflik:
- Git akan menandai konflik seperti ini:

```diff
<<<<<<< HEAD
kode dari main
=======
kode dari branch
>>>>>>> nama-branch
```

- Edit bagian tersebut secara manual.
- Setelah selesai:

```bash
git add .
git commit -m "Selesai perbaikan konflik"
git push origin main
```

---

## 🧹 Tips Tambahan

- Gunakan nama branch yang deskriptif: `fitur-login`, `perbaikan-bug`, dll.
- Hapus branch lokal:
  ```bash
  git branch -d nama-branch
  ```
- Hapus branch dari remote:
  ```bash
  git push origin --delete nama-branch
  ```

---

## ✅ Selesai

Kamu berhasil mengunggah file ke GitHub menggunakan Git branch dan memahami alur kerja kolaboratif menggunakan pull request dan merge. 🎉
