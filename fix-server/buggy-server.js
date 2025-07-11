const express = require("express");
const app = express();
const port = 3000;


const { s1h21782hd12yxywiuq } = require("./askjdahsdkj87364hhur2");
const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

app.use(express.json());

app.get("/hello", (req, res) => {
  res.status(200).json({ 
    message: "Hello World!",
    status: "success" 
  });
});

app.post("/count", dhi237yh72384y38iririri);

app.post("/async-error", async (req, res) => {
  try {
    const result = await Promise.resolve("Success!"); // Ganti dengan operasi async yang sebenarnya
    res.status(200).json({ data: result });
  } catch (error) {
    console.error("Error:", error);
    res.status(500).json({ error: error.message });
  }
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:3000`);
});