export const dhi237yh72384y38iririri = (req, res) => {
  res.setHeader('Content-Type', 'text/plain'); // atau 'text/event-stream' untuk streaming

  let count = 0;
  while (count < 10) {
    res.write(`Count: ${count}\n`);
    count++;
  }

  res.end();
};
