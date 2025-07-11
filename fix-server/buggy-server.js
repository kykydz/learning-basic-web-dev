const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

app.get("/hello", (req, res) => {
  res.status(200).json({ 
    message: "Hello World!",
    status: "success" 
  });
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:3000`);
});