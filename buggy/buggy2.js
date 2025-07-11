exports.dhi237yh72384y38iririri = (req, res) => {
  let count = 0;
  let output = "";

  while (count < 10) {
    output += `Count: ${count}\n`; // ← pakai backtick
    count++;
  }

  res.setHeader("Content-Type", "text/plain");
  res.end(output);
};
