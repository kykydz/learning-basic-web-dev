// db.js
const mysql = require('mysql2');

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',       // sesuaikan password MySQL kamu
  database: 'pweb_responsi'
});

db.connect((err) => {
  if (err) throw err;
  console.log('Terhubung ke database MySQL');
});

module.exports = db;
