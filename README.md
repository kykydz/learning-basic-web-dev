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

```bash
npm install express
```
Ada beberapa bug dan kesalahan pada file yang Anda sebutkan, baik pada sisi logika maupun sintaksis. Berikut adalah analisisnya:

### **1. Masalah pada file `askjdahsdkj87364hhur2.js`:**

```javascript
export const s1h21782hd12yxywiuq = (req, res) => {
  if (!req.body.error) {
    res.status(500).send("Internal Server Error");
  }
  res.status(200).send(new Error(req.body.error));
});
```

**Masalah:**

* **Kondisi yang tidak sesuai**: Jika `req.body.error` tidak ada, kode mengirimkan respons error 500. Namun, tidak ada return setelah mengirim status 500, sehingga eksekusi tetap berlanjut dan kode berikutnya (`res.status(200).send(new Error(req.body.error));`) tetap dijalankan. Ini akan menyebabkan dua respons dikirimkan (500 dan 200), yang tidak bisa dilakukan di HTTP.
* **Perbaikan:** Harus ada `return` setelah mengirim status 500 untuk menghentikan eksekusi.

**Perbaikan:**

```javascript
exports.s1h21782hd12yxywiuq = (req, res) => {
    res.status(200).send({ message: "hello ahmad rizal" });
};
```

---

### **2. Masalah pada file `buggy-server.js`:**

```javascript
const express = require("express");
const app = express();
const port = 3000;

// app.use(express.json());  // Ini dikomentari, yang menyebabkan masalah saat memparsing body JSON.

const routes = require("./routes");
const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

app.patch("/hello", askjdbiey273h7i2);  // Fungsi ini tidak didefinisikan

app.post("/count", dhi237yh72384y38iririri);

app.post("/async-error", (req, res) => {
  const result = await Promise.reject("Oops!");  // Syntax error karena 'await' digunakan tanpa 'async' di fungsi.
  res.send(result);
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:3306`);
});
```

**Masalah:**

* **Komentar `app.use(express.json())`**: Kode ini dikomentari. Jika body request yang diterima adalah JSON, Anda perlu mengaktifkan `express.json()` untuk parsing body. Tanpa ini, Anda akan kesulitan untuk mengakses `req.body` jika isinya adalah JSON.
* **Fungsi `askjdbiey273h7i2` yang tidak didefinisikan**: Fungsi `askjdbiey273h7i2` tidak didefinisikan, jadi akan muncul error "undefined function" saat mencoba mengakses endpoint `/hello`.
* **`await` tanpa `async`**: Pada endpoint `/async-error`, penggunaan `await` tanpa menandai fungsi sebagai `async` akan menghasilkan error. Anda perlu menambahkan kata kunci `async` pada fungsi.

**Perbaikan:**

```javascript
const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

const { s1h21782hd12yxywiuq } = require("./askjdahsdkj87364hhur2");
const { dhi237yh72384y38iririri } = require("./uyeuwq6623838-8234rur");

app.patch("/hello", s1h21782hd12yxywiuq);

app.post("/count", dhi237yh72384y38iririri);

app.post("/async-error", async (req, res) => {
    try {
        const result = await Promise.reject("Oops!");
        res.send(result);
    } catch (err) {
        res.status(500).send({ error: err });
    }
});

app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});
```

---

### **3. Masalah pada file `uyeuwq6623838-8234rur.js`:**

```javascript
export const dhi237yh72384y38iririri = (req, res) => {
  let count = 0;
  while (count < 10) {
    res.write(`Count: ${count}`);
  }
  res.end();
};
```

**Masalah:**

* **Loop tak terbatas**: Fungsi `while (count < 10)` tidak mengubah nilai `count`, jadi ini akan menjadi loop tak terbatas, yang mengarah pada aplikasi hang atau tidak merespons. `count` perlu dinaikkan dalam loop untuk memastikan bahwa loop berhenti setelah 10 iterasi.

**Perbaikan:**

```javascript

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
```

---

### **Kesimpulan:**

* **`askjdahsdkj87364hhur2.js`**: Perbaiki pengiriman response agar tidak terjadi pengiriman ganda dengan menambahkan `return` setelah status 500.
* **`buggy-server.js`**: Aktifkan `express.json()`, definisikan fungsi yang hilang, dan perbaiki penggunaan `await` dengan menambahkan `async` pada fungsi.
* **`uyeuwq6623838-8234rur.js`**: Perbaiki loop dengan menambahkan inkremen pada `count` agar loop berhenti setelah 10 iterasi.

run
```bash
node buggy-server.js
```