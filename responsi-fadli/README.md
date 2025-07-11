Nama: [Muh Fadli Akbar]
NIM: [221051024]

Daftar Perbaikan yang Dilakukan pada Server
Dokumen ini merinci bug, error, dan masalah lain yang telah diperbaiki pada file server (buggy-server.js) dan file-file pendukungnya (askjdahsdkj87364hhur2.js, uyeuwq6623838-8234rur.js) agar server dapat berjalan dengan baik dan semua API dapat diakses sesuai fungsinya.

Ringkasan Masalah Awal dan Perbaikannya:
1. buggy-server.js
Masalah: Variabel askjdbiey273h7i2 tidak terdefinisi saat digunakan sebagai handler untuk app.patch("/hello", askjdbiey273h7i2);.

Perbaikan: Mengimpor s1h21782hd12yxywiuq dari askjdahsdkj87364hhur2.js dan memberikan alias askjdbiey273h7i2 agar dapat digunakan sebagai handler.

Masalah: Penggunaan await Promise.reject("Oops!"); di dalam endpoint /async-error berada di fungsi callback yang tidak ditandai sebagai async. Ini menyebabkan SyntaxError.

Perbaikan: Menambahkan kata kunci async pada fungsi callback untuk endpoint /async-error.

Masalah: Tidak ada penanganan error (try...catch) untuk Promise.reject() di /async-error, yang akan menyebabkan server crash jika error terjadi.

Perbaikan: Menambahkan blok try...catch di sekitar await Promise.reject() untuk menangkap error dan mengirim respons 500 Internal Server Error yang graceful ke klien.

Masalah: Middleware app.use(express.json()); dikomentari, sehingga req.body tidak dapat diurai dengan benar untuk permintaan POST atau PATCH.

Perbaikan: Mengaktifkan kembali app.use(express.json()); untuk memastikan parsing body JSON berfungsi.

Masalah: Pesan console.log saat server berjalan menunjukkan port 3306, padahal variabel port disetel ke 3000.

Perbaikan: Mengubah console.log agar menggunakan variabel port (http://localhost:${port}) sehingga konsisten dengan port yang sebenarnya digunakan.

Masalah: Endpoint /count dan /async-error didefinisikan sebagai POST, tetapi pengguna mungkin mencoba mengaksesnya dengan GET (misalnya melalui browser), yang menghasilkan "Cannot GET /..." error.

Perbaikan: Mengedukasi pengguna untuk menggunakan metode HTTP yang benar (POST atau PATCH) saat menguji endpoint ini, seperti yang ditunjukkan dalam perintah curl di konsol server.

2. askjdahsdkj87364hhur2.js
Masalah: Logika respons di s1h21782hd12yxywiuq bermasalah; mengirim respons tanpa return dan mencoba mengirim objek Error sebagai respons 200 OK.

Perbaikan: Memastikan setiap jalur respons memiliki return res.status(...).send(...) untuk mencegah "headers already sent" error. Mengirimkan string error yang informatif (bukan objek Error) dengan status 400 Bad Request jika req.body.error ada, dan respons sukses 200 OK jika tidak.

3. uyeuwq6623838-8234rur.js
Masalah: Loop while (count < 10) adalah infinite loop karena variabel count tidak pernah di-increment (count++ hilang).

Perbaikan: Menambahkan count++; di dalam loop untuk memastikan count bertambah di setiap iterasi, sehingga loop dapat berhenti setelah 10 iterasi.

Masalah: Penggunaan res.write() di dalam loop tanpa res.end() di akhir, yang dapat menyebabkan permintaan menggantung atau respons tidak lengkap.

Perbaikan: Mengumpulkan semua output ke dalam sebuah string (responseText) dan mengirimkannya sekaligus menggunakan res.send(responseText) setelah loop selesai, yang lebih sesuai untuk respons teks lengkap dan secara otomatis mengakhiri respons.

Dengan perbaikan-perbaikan ini, server sekarang seharusnya dapat berjalan dengan stabil dan semua API dapat diakses dengan benar menggunakan metode HTTP yang sesuai.