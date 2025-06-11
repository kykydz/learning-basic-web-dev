1. Siapkan Akun dan Repositori GitHub
    buka browser dan Login ke GitHub: https://github.com
    jika belum punya akun klik sign up untuk mendaftar

        > Buat Repository Baru:

            Klik tombol New atau + → New repository.

            isi informasi repositori
            reposity name
            contohnya nama project

            Deskripsi

            pilih visibilitas
            bisa memilih public dan private

            Klik Create repository.

            copy url reposity yang muncul
            contohnya https://github.com/WahyuuMaulana

2. Siapkan Proyek di Komputer
    Jika Anda sudah punya folder proyek lokal
        > buka terminal atau cmd, git bash, dan arahkan ke dalam folder proyek
        cd path/to/nama_project

    Jika belum ada, buat:
        > buat folder project baru
        mkdir nama_project
        cd nama_project

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
    Ubah nama branch ke main dan kirim ke github

    bash
    git branch -M main
    git push -u origin main

6. cek di github
    buka browser dan akses url reposity, contohnya
    https://github.com/WahyuuMaulana/bleeh
    jika berhasil semua file dari folder lokal akan muncul di dalam halaman tersebut

7. Update file dan push
    jika ingin melakukan perubahan pada file
    git add .
    git commit -m "perubahan baru
    git push

8. cek status git
    git status

9. buat branch baru
    git checkout -b nama_branch