const express = require("express");
const app = express();
const port = 3000;

// Middleware
app.use(express.json());

// Routes
const { countHandler } = require("./uyeuwq6623838-8234rur");
const { errorHandler } = require("./askjdahsdkj87364hhur2");

app.patch("/hello", (req, res) => {
  res.status(200).json({ message: "Hello World" });
});

app.post("/count", countHandler);

app.post("/async-error", async (req, res) => {
  try {
    const result = await Promise.resolve("Success");
    res.json({ result });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Start server
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});