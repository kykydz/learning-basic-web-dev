const express = require('express');
const cors = require('cors');
const mysql = require('mysql2/promise');

const port = 3001;

(async () => {
    const app = express();
    app.use(cors());
    app.use(express.json());

    const connection = await mysql.createConnection({
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'mhs_db',
    });

    // === GET semua mahasiswa ===
    app.get('/api/students', async (req, res) => {
        try {
            const [results] = await connection.query('SELECT * FROM students');
            res.json({
                data: results,
                message: 'Data mahasiswa berhasil diambil',
            });
        } catch (err) {
            console.error(err);
            res.status(500).json({ message: 'Gagal mengambil data' });
        }
    });

    // === POST mahasiswa baru ===
    app.post('/api/students', async (req, res) => {
        const { nim, nama, jurusan } = req.body;
        try {
            await connection.query(
                'INSERT INTO students (nim, nama, jurusan) VALUES (?, ?, ?)',
                [nim, nama, jurusan]
            );
            res.status(201).json({ message: 'Mahasiswa ditambahkan' });
        } catch (err) {
            console.error(err);
            res.status(500).json({ message: 'Gagal menambahkan mahasiswa' });
        }
    });

    // === PATCH (update) mahasiswa ===
    app.patch('/api/students/:id', async (req, res) => {
        const { id } = req.params;
        const { nim, nama, jurusan } = req.body;
        try {
            await connection.query(
                'UPDATE students SET nim = ?, nama = ?, jurusan = ? WHERE id = ?',
                [nim, nama, jurusan, id]
            );
            res.json({ message: 'Data mahasiswa diperbarui' });
        } catch (err) {
            console.error(err);
            res.status(500).json({ message: 'Gagal memperbarui data' });
        }
    });

    // === DELETE mahasiswa ===
    app.delete('/api/students/:id', async (req, res) => {
        const { id } = req.params;
        try {
            await connection.query('DELETE FROM students WHERE id = ?', [id]);
            res.json({ message: 'Data mahasiswa dihapus' });
        } catch (err) {
            console.error(err);
            res.status(500).json({ message: 'Gagal menghapus data' });
        }
    });

    app.listen(port, () => console.log(`API server running on port ${port}`));
})();
