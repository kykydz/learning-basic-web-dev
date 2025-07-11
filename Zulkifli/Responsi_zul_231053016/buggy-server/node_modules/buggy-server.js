const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

// ✅ Endpoint GET /count
app.get("/count", dhi237yh72384y38iririri);

// ✅ Contoh perbaikan async-error
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
