

// Handler buat endpoint /hello
const helloHandler = (req, res) => {
  // Langsung kirim sapaan, simpel dan to the point.
  res.status(200).send("Woy, servernya udah bener nih, mantap!");
};

// Handler buat endpoint /count
const countHandler = (req, res) => {
  let count = 0;
  // FIX: Dikasih count++ biar loop-nya gak abadi dan bikin server hang.
  while (count < 10) {
    res.write(`Count: ${count}\n`);
    count++;
  }
  res.end(); // Kelarin respons kalo udah selesai.
};

// Handler buat nangkep error asinkron
const asyncErrorHandler = async (req, res) => {
  try {
    // FIX: Kode yang rawan error dibungkus try...catch biar server gak ambyar.
    await Promise.reject("Oops! Errornya ketangkep, bos!");
  } catch (error) {
    res.status(500).send(error);
  }
};

// Ekspor semua fungsi biar bisa diimpor sama file lain.
module.exports = {
  helloHandler,
  countHandler,
  asyncErrorHandler,
};