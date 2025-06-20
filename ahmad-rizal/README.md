# Git Dasar, Branching, Remote, dan Fitur Lanjutan

## Pendahuluan
Git adalah sistem kontrol versi terdistribusi yang digunakan untuk mencatat perubahan dalam file dan mengoordinasikan pekerjaan antar tim pengembang. Git bersifat open source dan sangat cepat dalam pengelolaan proyek skala besar dan kecil.

---

## 1. Dasar Git

### 1.1 Instalasi Git
- **Windows**: Unduh installer di https://git-scm.com
- **MacOS**: Gunakan Homebrew: `brew install git`
- **Linux**: Gunakan APT/DNF/YUM: `sudo apt install git`

### 1.2 Konfigurasi Awal
```bash
git config --global user.name "Ahmad Rizal"
git config --global user.email "ahmaddrizalul@gmail.com"
git config --global core.editor "code --wait"
git config --global init.defaultBranch main
```

### 1.3 Membuat Repository
```bash
git init
```
Untuk membuat repository lokal.

### 1.4 Menambahkan dan Commit File
```bash
git add .            # Menambahkan semua file

git commit -m "Initial commit"
```

### 1.5 Melihat Informasi
```bash
git status           # Menampilkan status working directory

git diff             # Menampilkan perbedaan antara file dan index

git log              # Menampilkan histori commit
```

### 1.6 File .gitignore
Digunakan untuk menghindari file tertentu masuk ke repository.
Contoh:
```
node_modules/
*.env
.DS_Store
```

---

## 2. Branching dan Workflow

### 2.1 Membuat dan Berpindah Cabang
```bash
git checkout -b nama_branch  # Buat dan pindah ke branch
```

### 2.2 Merge dan Konflik
```bash
git checkout main

git merge nama_branch
```
Jika konflik muncul, perbaiki manual lalu:
```bash
git add .
git commit
```

### 2.3 Rebase
Rebase menjaga histori tetap linear.
```bash
git rebase main
```

### 2.4 Delete Branch
```bash
git branch -d nama_branch      # Hapus branch lokal
```

---

## 3. Remote Repository

### 3.1 Remote Awal
```bash
git remote add origin https://github.com/user/repo.git
git push -u origin main
```

### 3.2 Sinkronisasi
```bash
git pull origin main
```

### 3.3 Clone Project
```bash
git clone https://github.com/user/repo.git
```

### 3.4 Melihat Remote
```bash
git remote -v
```

### 3.5 Menghapus/Mengubah Remote
```bash
git remote remove origin

git remote set-url origin https://baru.git
```

---

## 4. Fitur Tambahan Git

### 4.1 Stash
```bash
git stash            # Simpan sementara

git stash list       # Lihat daftar stash

git stash apply      # Terapkan stash
```

### 4.2 Tagging Versi
```bash
git tag v1.0

git tag -a v1.1 -m "Release versi 1.1"

git push origin --tags
```

### 4.3 Reset vs Revert
```bash
git reset --hard HEAD~1    # Menghapus commit

git revert <hash>          # Membuat commit baru yang membalikkan perubahan
```

### 4.4 Cherry-pick
```bash
git cherry-pick <hash_commit>   # Mengambil commit tertentu dari branch lain
```

### 4.5 Bisect
Digunakan untuk mencari commit yang menyebabkan bug.
```bash
git bisect start
git bisect bad
git bisect good <hash_terakhir_dikenal_baik>
```
Git akan otomatis membawa kita ke tengah-tengah histori commit untuk pengujian.

### 4.6 Blame
```bash
git blame nama_file.txt   # Melihat siapa yang mengubah setiap baris file
```

---

## 5. Alur Kerja Git (Workflow)

### 5.1 Git Flow
Struktur branch:
- `main`: Produksi
- `develop`: Pengembangan
- `feature/*`: Fitur baru
- `release/*`: Persiapan rilis
- `hotfix/*`: Perbaikan kritis

### 5.2 Pull Request (GitHub/GitLab)
1. Buat branch `feature/fitur-baru`
2. Push ke remote
3. Buat Pull Request (PR)
4. Review dan merge ke `main`

### 5.3 CI/CD Workflow
- Push ke GitHub → Trigger GitHub Actions
- Build, test, dan deploy otomatis

---

## 6. Perintah Git Berguna

| Perintah | Keterangan |
|----------|------------|
| `git log --graph --oneline --all` | Visualisasi semua branch |
| `git reflog` | Riwayat referensi HEAD (bisa digunakan untuk recovery) |
| `git clean -fd` | Menghapus file/direktori tidak terlacak |
| `git archive` | Buat arsip zip dari repo |
| `git shortlog -sn` | Lihat kontribusi per user |
| `git config --list` | Lihat semua konfigurasi Git |

---

## Penutup
Dengan penguasaan lengkap terhadap Git, Anda bisa:
- Mengelola versi proyek dengan rapi.
- Bekerja secara kolaboratif dengan tim.
- Menangani konflik dan bug dengan efisien.
- Menerapkan alur kerja profesional (Git Flow, PR, CI/CD).

Terus berlatih dengan membuat proyek dan eksplorasi fitur Git secara langsung. Git adalah alat penting dalam pengembangan perangkat lunak modern.

---

> Dokumentasi ini bisa dijadikan referensi praktis maupun pembelajaran mendalam Git dari pemula hingga lanjutan.