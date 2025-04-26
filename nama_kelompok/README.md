Berikut langkah-langkah menaruh code di github:

📋 Langkah-Langkah Lengkap Menaruh Code ke GitHub:
1. Inisialisasi Repositori Git Lokal
   - Buka terminal atau command prompt.
   - Pindah ke folder proyek menggunakan cd.
   - Jalankan perintah:
     git init
   - Ini akan membuat folder tersembunyi di dalam proyek, menandakan bahwa folder itu sekarang adalah repositori Git.

2. Tambahkan Semua Kode ke Staging Area
   - Setelah inisialisasi, semua file masih belum "terdaftar" ke Git.
   - Jalankan:
     git add .
   - Titik (.) berarti semua file dan folder akan ditambahkan ke area staging Git.

3. Membuat Komit Pertama
   - Setelah file masuk ke staging area, harus membuat komit untuk merekam perubahan.
   - Jalankan:
     git commit -m "first commit"
   - Gunakan pesan komit (`-m "..."`) yang jelas dan mendeskripsikan perubahan yang lakukan.

4. Membuat Repositori Baru di GitHub
   - Buka GitHub di browser.
   - Klik tombol New Repository.
   - Beri nama repositori (contoh: learning-basic-web-dev), lalu klik Create repository.
   - Jangan centang opsi untuk langsung membuat README.md kalau sudah punya file di lokal.

5. Menghubungkan Repositori Lokal dengan GitHub
   - Setelah membuat repositori GitHub, akan mendapatkan URL seperti:     https://github.com/username/nama-repo.git
   - Jalankan perintah untuk menghubungkan repositori lokal dengan remote:
     git remote add origin https://github.com/username/nama-repo.git
   - `origin` adalah nama default untuk remote server GitHub.

6. Mendorong (Push) Kode ke GitHub
   - Untuk mengirim file dari lokal ke GitHub, jalankan:
     bash
     git push -u origin main
     
   - -u membuat Git mengingat remote branch, jadi ke depannya cukup ketik git push saja tanpa detail tambahan.
   - main adalah nama cabang default (branch utama) di banyak repositori baru GitHub.

7. Cek Repositori di GitHub
   - Buka kembali GitHub dan masuk ke repositori.
   - Refresh halaman, maka file-filenya sudah muncul di repositori online.
