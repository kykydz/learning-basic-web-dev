// uyeuwq6623838-8234rur.js - Handler yang sudah diperbaiki dan menggunakan ES Modules

// Export fungsi dhi237yh72384y38iririri menggunakan sintaks ES Modules
export const dhi237yh72384y38iririri = (req, res) => {
  let count = 0;
  let responseText = ""; // Mengumpulkan output sebelum mengirimnya

  // Loop sekarang akan berhenti setelah 10 iterasi karena 'count' di-increment.
  while (count < 10) {
    responseText += `Count: ${count}\n`; // Menambahkan baris ke string respons
    count++; // Penting: increment 'count' agar loop tidak infinite
  }
  // Mengirim seluruh string respons setelah loop selesai.
  // res.send() lebih cocok untuk mengirim string atau JSON.
  // res.write() biasanya digunakan untuk streaming data, yang lebih kompleks.
  res.send(responseText);
};
