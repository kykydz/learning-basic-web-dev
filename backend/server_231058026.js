const express = require('express');
const app = express();
const PORT = 8026;

app.get('/', (req, res) => {
    res.json({ message: 'Halo dari backend Express NIM 231058026' });
});

app.listen(PORT, () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
});
