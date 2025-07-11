"# Kemal Responsi Web Dev" 
Nama : NASYA KEMAL GIFFARI
NIM : 231057018

1. await digunakan di luar fungsi async
Salah: await Promise.reject(...) dalam fungsi biasa
Perbaikan: Tambahkan async dan try...catch

2. Template literal salah pakai ' bukan `
Salah: 'Terjadi error: ${error}'
Perbaikan: `Terjadi error: ${error}`

3. Infinite loop karena count++ tidak ditulis
Salah: while (count < 10) { res.write(...); }
Perbaikan: Tambahkan count++ di dalam loop

4. Teks literal 'Count: count' tidak menampilkan angka
Perbaikan: Gunakan template literal `Count: ${count}`

5. Console log port tidak dinamis
Salah: console.log('Server running on http://localhost:3306')
Perbaikan: console.log(\Server running on http://localhost:${port}\`)`
