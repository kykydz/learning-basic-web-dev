const express = require("express");
const app = express();
const port = 3000;

// FIX 4: Memuat dan menggunakan semua rute dari routes.js
const allRoutes = require("./routes.js");
app.use(allRoutes);

app.listen(port, () => {
  // FIX 5: Menggunakan variabel port agar pesan log akurat
  console.log(`Server berjalan di http://localhost:${port}`);
});