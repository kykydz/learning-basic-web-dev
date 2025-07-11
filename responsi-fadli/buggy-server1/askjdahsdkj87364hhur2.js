// askjdahsdkj87364hhur2.js - Handler yang sudah diperbaiki (tidak ada perubahan dari sebelumnya)

export const s1h21782hd12yxywiuq = (req, res) => {
  if (req.body && req.body.error) {
    console.log(`Client requested error: ${req.body.error}`);
    return res.status(400).send(`Client Error: ${req.body.error}`);
  } else {
    return res.status(200).send("Hello PATCH request received successfully!");
  }
};
