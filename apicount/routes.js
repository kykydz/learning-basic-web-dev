const express = require("express");
const router = express.Router();

// FIX 3: Mengimpor handler dari file handlers.js
const { countHandler } = require("./handlers.js");

// Menghubungkan endpoint POST /count dengan logikanya
router.post("/count", countHandler);

module.exports = router;