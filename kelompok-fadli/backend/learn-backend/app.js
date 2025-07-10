// app.js
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2/promise');
const cors = require('cors');

const app = express();
const port = 3001; // Port untuk backend

// Middleware untuk mengurai body permintaan JSON
app.use(bodyParser.json());
// Middleware untuk mengizinkan CORS (penting untuk koneksi frontend)
app.use(cors());

// Variabel untuk menyimpan koneksi database
let connection;

// Fungsi async untuk menginisialisasi koneksi database
async function initializeDatabaseConnection() {
  try {
    connection = await mysql.createConnection({
      host: 'localhost',
      user: 'root',
      password: '', // Ganti dengan password MySQL Anda jika ada
      database: 'my_db', // Ganti dengan nama database Anda
    });
    console.log('Terhubung ke database MySQL dengan ID: ' + connection.threadId);
  } catch (err) {
    console.error('Gagal terhubung ke database MySQL:', err.stack);
    process.exit(1); // Keluar dari aplikasi jika koneksi database gagal
  }
}

// Panggil fungsi inisialisasi database sebelum memulai server
initializeDatabaseConnection();

// --- API CRUD untuk Pengguna ---

// GET semua pengguna
app.get('/users', async (req, res) => {
  try {
    const [rows] = await connection.execute('SELECT id, name, username, email, phone, website, city FROM users');
    res.json(rows);
  } catch (error) {
    console.error('Error saat mengambil semua pengguna:', error);
    res.status(500).json({ message: 'Terjadi kesalahan server.' });
  }
});

// GET pengguna berdasarkan ID
app.get('/users/:id', async (req, res) => {
  try {
    const userId = req.params.id;
    const [rows] = await connection.execute('SELECT id, name, username, email, phone, website, city FROM users WHERE id = ?', [userId]);

    if (rows.length === 0) {
      return res.status(404).json({ message: 'Pengguna tidak ditemukan.' });
    }

    res.json(rows[0]);
  } catch (error) {
    console.error('Error saat mengambil pengguna berdasarkan ID:', error);
    res.status(500).json({ message: 'Terjadi kesalahan server.' });
  }
});

// POST pengguna baru
app.post('/users', async (req, res) => {
  try {
    const { name, username, email, phone, website, city } = req.body;
    if (!name || !username || !email) {
      return res.status(400).json({ message: 'Nama, username, dan email wajib diisi.' });
    }

    const [result] = await connection.execute(
      'INSERT INTO users (name, username, email, phone, website, city) VALUES (?, ?, ?, ?, ?, ?)',
      [name, username, email, phone, website, city]
    );

    const [newUserRows] = await connection.execute('SELECT * FROM users WHERE id = ?', [result.insertId]);
    res.status(201).json(newUserRows[0]);
  } catch (error) {
    console.error('Error saat membuat pengguna:', error);
    if (error.code === 'ER_DUP_ENTRY') {
      return res.status(409).json({ message: 'Username atau Email sudah ada.' });
    }
    res.status(500).json({ message: 'Terjadi kesalahan server.' });
  }
});

// PATCH (memperbarui sebagian) pengguna berdasarkan ID
app.patch('/users/:id', async (req, res) => {
  try {
    const userId = req.params.id;
    const updates = req.body;

    if (Object.keys(updates).length === 0) {
      return res.status(400).json({ message: 'Tidak ada data yang disediakan untuk pembaruan.' });
    }

    const setClauses = [];
    const params = [];
    for (const key in updates) {
      if (updates.hasOwnProperty(key)) {
        setClauses.push(`${key} = ?`);
        params.push(updates[key]);
      }
    }
    params.push(userId);

    const query = `UPDATE users SET ${setClauses.join(', ')} WHERE id = ?`;
    const [result] = await connection.execute(query, params);

    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'Pengguna tidak ditemukan atau tidak ada perubahan yang dilakukan.' });
    }

    const [updatedUserRows] = await connection.execute('SELECT * FROM users WHERE id = ?', [userId]);
    res.json(updatedUserRows[0]);
  } catch (error) {
    console.error('Error saat memperbarui pengguna:', error);
    if (error.code === 'ER_DUP_ENTRY') {
      return res.status(409).json({ message: 'Username atau Email sudah ada.' });
    }
    res.status(500).json({ message: 'Terjadi kesalahan server.' });
  }
});

// DELETE pengguna berdasarkan ID
app.delete('/users/:id', async (req, res) => {
  try {
    const userId = req.params.id;
    const [result] = await connection.execute('DELETE FROM users WHERE id = ?', [userId]);

    if (result.affectedRows === 0) {
      return res.status(404).json({ message: 'Pengguna tidak ditemukan.' });
    }

    res.status(204).send();
  } catch (error) {
    console.error('Error saat menghapus pengguna:', error);
    res.status(500).json({ message: 'Terjadi kesalahan server.' });
  }
});

// Menjalankan server
app.listen(port, () => {
  console.log(`Server backend berjalan di http://localhost:${port}`);
});
