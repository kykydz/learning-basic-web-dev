# nama: Zulkifli A R Saleh

# NIM : 231053016

# 🐞 Buggy Server — Responsi Pemrograman Web

## 📌 Deskripsi

Project ini merupakan hasil perbaikan dari kode server Node.js (Express) yang memiliki banyak bug. Tugas utamanya adalah:

- Memperbaiki endpoint `/count` agar bisa mengembalikan data hitungan 0-9.
- Menyusun ulang kode agar dapat dijalankan tanpa error.
- Menyediakan dokumentasi permasalahan dan solusi.

---

## 🧨 Permasalahan yang Ditemukan

1. **Modul tidak ditemukan (`./routes`)**

   - Diimpor pada `buggy-server.js`, namun file `routes.js` tidak ada.

2. **Fungsi handler tidak didefinisikan**

   - Contoh: `askjdbiey273h7i2` digunakan di endpoint `/hello`, padahal tidak pernah dibuat.

3. **Infinite loop pada handler `/count`**

   - Loop `while (count < 10)` tidak pernah menambahkan `count++`, sehingga tidak pernah selesai.

4. **Penulisan `await` di luar `async` function**

   - Di route `/async-error`, `await` digunakan tanpa `async`, menyebabkan error runtime.

5. **Port log tidak sesuai**
   - Server jalan di `port 3000`, tapi console.log menunjukkan `port 3306`.

---

## ✅ Solusi yang Diterapkan

1. **Menghapus impor modul yang tidak ada**
   ```js
   // const routes = require('./routes'); ← dihapus
   ```
