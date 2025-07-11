const express = require("express");
const app = express();
const port = 3000;

// app.use(express.json());

const routes = require("./routes");
const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

app.patch("/hello", askjdbiey273h7i2);

app.post("/count", dhi237yh72384y38iririri);

app.post("/async-error", (req, res) => {
  const result = await Promise.reject("Oops!");
  res.send(result);
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:3306`);
});
