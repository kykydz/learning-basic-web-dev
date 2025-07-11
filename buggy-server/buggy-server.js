const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

const { s1h21782hd12yxywiuq } = require("./askjdahsdkj87364hhur2");
const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

app.patch("/hello", s1h21782hd12yxywiuq);

app.post("/count", dhi237yh72384y38iririri);

app.post("/async-error", async (req, res) => {
    try {
        const result = await Promise.reject("Oops!");
        res.send(result);
    } catch (err) {
        res.status(500).send({ error: err });
    }
});

app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});