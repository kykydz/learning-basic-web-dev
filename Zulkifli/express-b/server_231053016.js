const express = require('express');
const db = require('./db');
const app = express();
const port = 3000;

app.use(express.json()); // untuk parsing body JSON

// GET root (opsional)
app.get('/', (req, res) => {
  res.send('API User berjalan');
});

// ✅ GET semua user
app.get('/users', (req, res) => {
  db.query('SELECT * FROM users', (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ✅ POST user baru
app.post('/users', (req, res) => {
  const { name, email } = req.body;
  if (!name || !email) {
    return res.status(400).json({ message: 'Nama dan email wajib diisi' });
  }

  db.query('INSERT INTO users (name, email) VALUES (?, ?)', [name, email], (err, result) => {
    if (err) return res.status(500).json({ error: err.message });

    res.status(201).json({ 
      message: 'User ditambahkan',
      id: result.insertId
    });
  });
});

// ✅ PUT update user berdasarkan id
app.put('/users/:id', (req, res) => {
  const { id } = req.params;
  const { name, email } = req.body;

  if (!name || !email) {
    return res.status(400).json({ message: 'Nama dan email wajib diisi' });
  }

  db.query('UPDATE users SET name = ?, email = ? WHERE id = ?', [name, email, id], (err, result) => {
    if (err) return res.status(500).json({ error: err.message });

    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'User tidak ditemukan' });
    }

    res.json({ message: 'User berhasil diperbarui' });
  });
});

// ✅ DELETE user berdasarkan id
app.delete('/users/:id', (req, res) => {
  const { id } = req.params;

  db.query('DELETE FROM users WHERE id = ?', [id], (err, result) => {
    if (err) return res.status(500).json({ error: err.message });

    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'User tidak ditemukan' });
    }

    res.json({ message: 'User berhasil dihapus' });
  });
});

// Menjalankan server
app.listen(port, () => {
  console.log(`✅ Server jalan di http://localhost:${port}`);
});
