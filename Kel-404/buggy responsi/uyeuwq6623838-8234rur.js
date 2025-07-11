export const countHandler = (req, res) => {
  let output = "";
  for (let count = 0; count < 10; count++) {
    output += `Count: ${count}\n`;
  }
  res.send(output);
};