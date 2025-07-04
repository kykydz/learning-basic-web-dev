const express = require('express');
const db = require('./db');
const app = express();
const port = 3000;

app.use(express.json()); // untuk parsing body JSON

app.get('/',(req,res) =>{
    
})

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

app.listen(port, () => {
  console.log('✅ Server jalan di http://localhost:3000');
});