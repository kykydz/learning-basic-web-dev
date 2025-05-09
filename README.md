# Belajar Git Dasar

## Apa itu Git?
Git adalah sistem kontrol versi (VCS) yang digunakan untuk melacak perubahan pada file, berkolaborasi dalam pengembangan proyek, dan mengelola riwayat perubahan.

## Perintah Git Dasar

### 1. Inisialisasi Repository
Membuat repository Git di folder lokal:
```bash
git init
```

### 2. Menambahkan File ke Staging Area
Menandai file untuk siap di-commit:
```bash
git add nama-file
# atau semua file
git add .
```

### 3. Commit Perubahan
Menyimpan snapshot perubahan ke repository:
```bash
git commit -m "Pesan commit"
```

### 4. Melihat Status Repository
Menampilkan status file:
```bash
git status
```

### 5. Melihat Riwayat Commit
Melihat semua commit yang sudah dibuat:
```bash
git log
```

### 6. Menghubungkan ke Repository Remote
Menghubungkan project lokal ke GitHub:
```bash
git remote add origin https://github.com/username/nama-repo.git
```

### 7. Push ke Remote Repository
Mengirim perubahan ke GitHub:
```bash
git push -u origin master
```
*(atau `main`, tergantung nama branch)*

### 8. Clone Repository
Mengunduh repository dari GitHub ke lokal:
```bash
git clone https://github.com/username/nama-repo.git
```

### 9. Pull Update dari Remote
Mengambil perubahan terbaru dari GitHub:
```bash
git pull origin master
```
*(atau `main`)*

## Tips
- Gunakan pesan commit yang jelas dan deskriptif.
- Selalu `git pull` sebelum mulai kerja untuk menghindari konflik.
- Gunakan branch saat mengembangkan fitur baru.