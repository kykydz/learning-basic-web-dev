

const express = require("express");
const router = express.Router(); // Bikin instance router dari Express

// Impor semua handler yang udah kita buat tadi.
const {
  helloHandler,
  countHandler,
  asyncErrorHandler,
} = require("./handlers.js");

// --- DAFTARIN SEMUA JALAN/ROUTE DI SINI ---

// Kalo ada request GET ke /hello, panggil helloHandler.
// FIX: Pake GET, bukan PATCH.
router.get("/hello", helloHandler);

// Kalo ada request POST ke /count, panggil countHandler.
router.post("/count", countHandler);

// Kalo ada request POST ke /async-error, panggil asyncErrorHandler.
router.post("/async-error", asyncErrorHandler);

// Ekspor routernya biar bisa dipake sama server utama.
module.exports = router;