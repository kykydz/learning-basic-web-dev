const express = require('express');
const app = express();
const PORT = 4023;

app.get('/api/data', (req, res) => {
  res.json([
    { id: 1, nama: 'Reinaldo', jurusan: 'Informatika' },
    { id: 2, nama: 'Budi', jurusan: 'Sistem Informasi' },
    { id: 3, nama: 'Sari', jurusan: 'Teknik Komputer' }
  ]);
});

app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
});
