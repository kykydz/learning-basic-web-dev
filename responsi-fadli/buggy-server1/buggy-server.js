// buggy-server.js - Server utama yang sudah diperbaiki (versi 2)

const express = require("express"); // Mengimpor modul express
const app = express();              // Membuat instance aplikasi express
const port = 3000;                  // Menentukan port server yang akan digunakan

// Mengaktifkan middleware untuk mengurai body permintaan dalam format JSON.
// Ini penting untuk mengakses req.body pada endpoint POST/PATCH.
app.use(express.json());

// Mengimpor fungsi handler dari file eksternal
// 's1h21782hd12yxywiuq' diimpor dan diberikan alias 'askjdbiey273h7i2'
// agar sesuai dengan penggunaan di bawah.
const { s1h21782hd12yxywiuq: askjdbiey273h7i2 } = require("./askjdahsdkj87364hhur2");
const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

// Jika Anda memiliki file routes.js yang ingin digunakan, uncomment baris ini.
// Pastikan routes.js mengekspor router Express yang valid.
// const routes = require("./routes");
// app.use('/', routes); // Contoh penggunaan router

// Endpoint PATCH untuk /hello
// 'askjdbiey273h7i2' sudah terdefinisi sebagai handler yang diimpor.
app.patch("/hello", askjdbiey273h7i2);

// Endpoint POST untuk /count
// Menggunakan handler yang diimpor dari uyeuwq6623838-8234rur.js
// Handler ini sekarang sudah diperbaiki agar tidak infinite loop.
app.post("/count", dhi237yh72384y38iririri);

// Endpoint POST untuk /async-error
// Fungsi callback ditandai 'async' agar 'await' dapat digunakan.
// Menambahkan try...catch untuk menangani Promise.reject secara graceful.
app.post("/async-error", async (req, res) => {
  try {
    // Simulasi error asinkron
    await Promise.reject("Oops! An async error occurred on purpose.");
    res.send("This should not be reached."); // Baris ini tidak akan tercapai
  } catch (error) {
    console.error("Async error caught:", error);
    // Mengirim respons error ke klien dengan status 500
    res.status(500).send(`Error: ${error}`);
  }
});

// Server mulai mendengarkan pada port yang ditentukan
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
  console.log(`Test /hello (PATCH): curl -X PATCH http://localhost:${port}/hello -H "Content-Type: application/json" -d '{"error": "some_error_message"}'`);
  console.log(`Test /count (POST): curl -X POST http://localhost:${port}/count`);
  console.log(`Test /async-error (POST): curl -X POST http://localhost:${port}/async-error`);
});
