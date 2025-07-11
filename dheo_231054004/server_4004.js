// server_4004.js
const express = require('express');
const app = express();
const PORT = 4004;
const db = require('./db');

app.use(express.json());

app.get('/', (req, res) => {
  res.send('Backend berjalan di port ' + PORT);
});

app.post('/data', (req, res) => {
  const { nama, nim, matkul } = req.body;

  if (!nama || !nim || !matkul) {
    return res.status(400).json({ error: 'Nama, NIM, dan mata kuliah wajib diisi' });
  }

  const sql = 'INSERT INTO mahasiswa (nama, nim, matkul) VALUES (?, ?, ?)';
  db.query(sql, [nama, nim, matkul], (err, result) => {
    if (err) {
      console.error('Gagal menyimpan ke database:', err);
      return res.status(500).json({ error: 'Gagal menyimpan ke database' });
    }

    res.json({
      message: 'Data berhasil disimpan',
      data: { nama, nim, matkul }
    });
  });
});

app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
});
