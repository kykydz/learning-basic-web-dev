// uyeuwq6623838-8234rur.js - Handler yang sudah diperbaiki (tidak ada perubahan dari sebelumnya)

export const dhi237yh72384y38iririri = (req, res) => {
  let count = 0;
  let responseText = ""; // Mengumpulkan output sebelum mengirimnya

  // Loop sekarang akan berhenti setelah 10 iterasi karena 'count' di-increment.
  while (count < 10) {
    responseText += `Count: ${count}\n`; // Menambahkan baris ke string respons
    count++; // Penting: increment 'count' agar loop tidak infinite
  }
  // Mengirim seluruh string respons setelah loop selesai.
  // Menggunakan res.send() yang lebih sesuai untuk mengirim respons teks.
  res.send(responseText);
};
