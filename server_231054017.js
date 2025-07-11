// server_231054017.js
const express = require('express');
const app = express();
const PORT = 4017; // 4 digit terakhir NIM

app.get('/', (req, res) => {
  res.send('Halo dari server NIM 231054017!');
});

app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
});
