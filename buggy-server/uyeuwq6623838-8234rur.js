
exports.dhi237yh72384y38iririri = (req, res) => {
    let count = 0;
    const interval = setInterval(() => {
        if (count >= 10) {
            clearInterval(interval);
            return res.end();
        }
        res.write(`Count: ${count}\n`);
        count++;
    }, 500);
};