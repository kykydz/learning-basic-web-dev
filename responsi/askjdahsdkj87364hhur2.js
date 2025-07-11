export const s1h21782hd12yxywiuq = (req, res) => {
  const { error } = req.body;

  if (!error) {
    return res.status(500).send("Internal Server Error");
  }

  res.status(400).json({ message: error }); // atau 422 tergantung jenis error
};
