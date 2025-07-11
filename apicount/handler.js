const countHandler = (req, res) => {
  let count = 0;
  // FIX 1: Menambahkan count++ untuk mencegah infinite loop
  while (count < 10) {
    res.write(`Count: ${count}\n`);
    count++;
  }
  res.end(); // Mengakhiri respons
};

// FIX 2: Mengekspor handler agar bisa digunakan file lain
module.exports = {
  countHandler,
};