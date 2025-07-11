DINUL HAYAT 231058026

BUGGS:
1. buggy-server.js
(Handler /hello tidak dikenali)
-Masalah: askjdbiey273h7i2 dipakai tapi tidak di-import.
-Solusi: Ganti dengan s1h21782hd12yxywiuq dari file askjdahsdkj87364hhur2.js, dan pastikan di-import.

(app.use(express.json()) dikomentari)
-Masalah: Body parser untuk JSON tidak aktif → req.body akan undefined → semua endpoint gagal.
-Solusi: Aktifkan app.use(express.json()).

(Port yang dicetak tidak sesuai)
-Masalah: app.listen(port) memakai port = 3000, tapi di log: localhost:3306 (port MySQL).
-Solusi: Perbaiki log ke http://localhost:3000.

(await dipakai tanpa async di /async-error)
-Masalah: Akan menyebabkan runtime crash (SyntaxError).
-Solusi: Tambahkan async pada handler function.

2. askjdahsdkj87364hhur2.js
(Objek Error dikirim langsung dalam res.send)
-Masalah: res.send(new Error(...)) mengirim objek Error, bisa menyebabkan crash atau payload tidak terbaca.
-Solusi: Ubah ke res.send({ message: ... }) atau res.send(error.message).

3. uyeuwq6623838-8234rur.js

(Infinite loop pada /count)
-Masalah: Tidak ada count++ → loop tidak pernah berhenti → server hang/CPU 100%.
-Solusi: Tambahkan count++ dan/atau gunakan setInterval untuk simulasi delay.

