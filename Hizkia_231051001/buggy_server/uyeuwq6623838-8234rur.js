export const dhi237yh72384y38iririri = (req, res) => {
  let count = 0;
  while (count < 10) {
    res.write(`Count: ${count}\n`);
    count++;
  }
  res.end();
};
