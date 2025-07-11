const express = require('express');
const app = express();
const PORT = 5403; 

app.use(express.json());


app.get('/', (req, res) => {
  res.json({
    message: 'Server berjalan dengan sukses!',
    nim: '231054003',
    port: PORT,
    status: 'Aktif'
  });
});

app.get('/api/data', (req, res) => {
  res.json({
    data: [
      { id: 1, name: 'Item 1' },
      { id: 2, name: 'Item 2' }
    ]
  });
});

app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
  console.log(`Dibuat oleh 231054003`);
});