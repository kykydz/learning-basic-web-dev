
const express = require("express");
const app = express();
const port = 3000;

// Impor semua route yang udah kita definisikan di routes.js
const allRoutes = require("./routes.js");

// Middleware buat baca body JSON dari request.
app.use(express.json());

// Bilang ke aplikasi Express buat pake semua route dari file routes.js
app.use(allRoutes);

// Nyalain servernya.
app.listen(port, () => {
  // FIX: Pake variabel `port` biar pesannya akurat.
  console.log(`Server gaskeun di http://localhost:${port}`);
});