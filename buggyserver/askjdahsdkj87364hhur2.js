
exports.s1h21782hd12yxywiuq = (req, res) => {
    if (!req.body.error) {
        return res.status(500).send("Internal Server Error");
    }
    res.status(200).send({ message: req.body.error });
};
