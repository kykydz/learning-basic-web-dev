const countHandler = (req, res) => {
  try {
    let output = "Counting from 0 to 9:\n\n";
    for (let i = 0; i < 10; i++) {
      output += `Count: ${i}\n`;
    }
    res.type('text').send(output);
  } catch (err) {
    res.status(500).json({ error: "Counter failed" });
  }
};

module.exports = { countHandler };