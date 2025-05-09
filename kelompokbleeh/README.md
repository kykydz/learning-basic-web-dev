1. Siapkan Akun dan Repositori GitHub
Login ke GitHub: https://github.com

Buat Repository Baru:

Klik tombol New atau + → New repository.

Isi nama repo, deskripsi (opsional), pilih Public atau Private.

Klik Create repository.

2. Siapkan Proyek di Komputer
Jika Anda sudah punya folder proyek lokal, buka terminal/command prompt dan arahkan ke folder tersebut:

bash
Salin
Edit
cd path/to/proyek-anda
Jika belum ada, buat:

bash
Salin
Edit
mkdir nama-proyek
cd nama-proyek
3. Inisialisasi Git dan Tambah Kode
bash
Salin
Edit
git init
git add .
git commit -m "Initial commit"
4. Hubungkan dengan GitHub Repo
Copy URL repo dari GitHub, misalnya:

arduino
Salin
Edit
https://github.com/username/nama-repo.git
Lalu di terminal:

bash
Salin
Edit
git remote add origin https://github.com/username/nama-repo.git
5. Push ke GitHub
bash
Salin
Edit
git branch -M main
git push -u origin main

