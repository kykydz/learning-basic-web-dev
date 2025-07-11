const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

// Handler langsung di dalam file
const countHandler = (req, res) => {
  let count = 0;
  res.setHeader("Content-Type", "text/plain");

  const interval = setInterval(() => {
    res.write(`Count: ${count}\n`);
    count++;

    if (count >= 10) {
      clearInterval(interval);
      res.end();
    }
  }, 500);
};

// Endpoint POST
app.post("/count", countHandler);

// Jalankan server
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
