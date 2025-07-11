const http = require('http');

//4 digit terakhir NIM Anda
const port = 7020;

// Buat server
const server = http.createServer((req, res) => {
  // Atur header respons dengan status code 200 (OK) dan tipe konten text/plain
  res.writeHead(200, { 'Content-Type': 'text/plain' });
  
  // Tulis pesan respons
  res.end('Server berjalan sukses!\n');
});

// Jalankan server dan buat agar mendengarkan permintaan di port yang ditentukan
server.listen(port, () => {
  console.log(`Server berjalan di http://localhost:${port}/`);
});
