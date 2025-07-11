export const s1h21782hd12yxywiuq = (req, res) => {
  if (req.body.error) {
    // Jika ada error
    res.status(500).json({ message: req.body.error });
  } else {
    // Tidak ada error
    res.status(200).send("OK");
  }
};
