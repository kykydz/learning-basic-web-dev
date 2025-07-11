const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

// ✅ Tambahkan endpoint /hello
app.get("/hello", (req, res) => {
  res.send("Hello, World!");
});

// Contoh penanganan error async (opsional)
app.post("/async-error", async (req, res) => {
  try {
    const result = await Promise.reject("Oops!");
    res.send(result);
  } catch (error) {
    res.status(500).send(`Terjadi error: ${error}`);
  }
});

app.listen(port, () => {
  console.log(`✅ Server berjalan di http://localhost:${port}`);
});
