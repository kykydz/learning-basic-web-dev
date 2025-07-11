// server_1234567890.js
const express = require('express');
const app = express();
const PORT = 1006;

app.get('/', (req, res) => {
    res.send('Server berjalan dengan sukses di port ' + PORT);
});

app.listen(PORT, () => {
    console.log(`Server aktif di http://localhost:${PORT}`);
});
