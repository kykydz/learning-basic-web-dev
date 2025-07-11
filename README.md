# RESPONSI PRAKTIKUM PEMROGRAMAN WEBSITE

- Nama: Ahmad Rizal
- NIM: 231057014

# A. PROJECT

## 1. Konfigurasi Database (rizal-backend/app.js)
```bash
const express = require('express');
const mysql = require('mysql2/promise');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

const connection = await mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'my_db',
});
```

## 2. Membuat Tabel users
```bash
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE
);
```

## 3. Penyesuaian Port API

Pastikan port API disesuaikan di backend dan frontend:
```bash
const port = 7014;
```

## 4. Minimal Package yang Digunakan

### Backend (rizal-backend)

Install package:
```bash
npm install express mysql2 cors
```

Penjelasan:

	•	express – Framework untuk membuat server API.
	•	mysql2 – Untuk koneksi database MySQL.
	•	cors – Agar frontend bisa mengakses API dari domain berbeda.

### Frontend (rizal-app)
Sesuikan port api yang sudah dibuat pada backend yaitu `port: 7014`
```bash
const apiService = {
  async fetchItems() {
    const resultPromise = await fetch('http://localhost:7014/api/users', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    const response = await resultPromise.json();
    console.log(response);

    return response.data.results;
  },
```

## 5. Menjalankan Backend

```bash
cd rizal-backend
node app.js
```

## 6. Menjalankan Frontend

```bash
cd rizal-frontend
npm start
```

# B. BUGGY SERVER
## 1. Bug yang Ditemukan
kesalahan penamaan file yang sebelumnya menggunakan .js maka diubah menjadi .html
