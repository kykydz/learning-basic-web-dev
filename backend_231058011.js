const express = require('express');
const app = express();
const PORT = 8011; // Gunakan 4 digit NIM terakhir

// Data contoh (mock API)
const users = [
  { id: 1, name: "Rifki", nim: "231058011" },
  { id: 2, name: "Tasya", nim: "231058012" }
];

// Route untuk menampilkan data
app.get('/users', (req, res) => {
  res.json(users);
});

// Route root
app.get('/', (req, res) => {
  res.send('Backend berjalan! Akses <a href="/users">/users</a> untuk melihat data.');
});

// Jalankan server
app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
});