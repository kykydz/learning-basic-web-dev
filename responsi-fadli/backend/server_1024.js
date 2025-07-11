const express = require('express');
const app = express();
const port = 1024; // Ganti XXXX dengan 4 digit terakhir NIM Anda

// Middleware untuk parsing JSON body
app.use(express.json());

// Route dasar
app.get('/', (req, res) => {
  res.send('Halo dari Backend Anda! Server berjalan.');
});

// Contoh API endpoint
app.get('/api/data', (req, res) => {
  res.json({
    message: 'Ini adalah data dari API custom Anda.',
    nim: port, // Menggunakan port sebagai NIM untuk contoh
    timestamp: new Date().toISOString()
  });
});

// Jalankan server
app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
  console.log(`Buka http://localhost:${port}/api/data untuk melihat data API.`);
});