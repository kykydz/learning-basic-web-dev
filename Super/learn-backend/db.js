const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',        // ganti jika ada password
  database: 'db_baru'  // ganti sesuai database kamu
});

connection.connect((err) => {
  if (err) {
    console.error('❌ Gagal konek:', err);
  } else {
    console.log('✅ Terhubung ke MySQL');
  }
});

module.exports = connection;