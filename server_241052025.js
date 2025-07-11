const express = require('express');
const app = express();
const port = 2025;

// Route utama
app.get('/', (req, res) => {
  res.send('Server berjalan di port 2025!');
});

// Route API contoh
app.get('/api/info', (req, res) => {
  res.json({
    nim: "241052025",
    nama: "Muhammad Fathul Kohir",
    pesan: "Berhasil membuat basic server"
  });
});

app.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}`);
});
