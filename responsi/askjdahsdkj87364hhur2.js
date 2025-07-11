export const s1h21782hd12yxywiuq = (req, res) => {
  if (!req.body.error) {
    res.status(500).send("Internal Server Error");
  }
  res.status(200).send(new Error(req.body.error));
});