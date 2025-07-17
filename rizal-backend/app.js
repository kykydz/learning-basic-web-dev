const express = require("express");
const mysql = require("mysql2/promise");
const cors = require("cors");

const port = 3005;

(async () => {
  const app = express();

  app.use(cors());
  app.use(express.json());

  const connection = await mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "library_db",
  });

  connection.connect((err) => {
    if (err) {
      console.error("error connecting: " + err.stack);
      return;
    }
    console.log("connected as id " + connection.threadId);
  });

  // Menampilkan semua pengunjung
  app.get("/api/visitors", async (req, res) => {
    try {
      const [results, fields] = await connection.query(
        "SELECT * FROM `visitors`"
      );
      res.json({
        data: {
          results,
        },
        message: "Visitors retrieved successfully",
      });
    } catch (error) {
      res.status(500).send({ message: "Server error" });
    }
  });

  // Menampilkan pengunjung berdasarkan ID
  app.get("/visitors/:id", async (req, res) => {
    const id = req.params.id;
    try {
      const [results, fields] = await connection.query(
        "SELECT * FROM `visitors` WHERE id = ?",
        [id]
      );
      if (results.length > 0) {
        res.json(results[0]);
      } else {
        res.status(404).send({ message: "Visitor not found" });
      }
    } catch (error) {
      res.status(500).send({ message: "Server error" });
    }
  });

  // Menambah pengunjung
  app.post("/visitors", async (req, res) => {
    const { name, address, phone_number, visit_date } = req.body;
    try {
      const [result] = await connection.query(
        "INSERT INTO `visitors` (name, address, phone_number, visit_date) VALUES (?, ?, ?, ?)",
        [name, address, phone_number, visit_date]
      );
      res.status(201).send({
        message: "Visitor added",
        data: {
          id: result.insertId,
          name,
          address,
          phone_number,
          visit_date,
        },
      });
    } catch (error) {
      res.status(500).send({ message: "Server error" });
    }
  });

  // Mengupdate data pengunjung
  app.patch("/visitors/:id", async (req, res) => {
    const id = req.params.id;
    const { name, address, phone_number, visit_date } = req.body;
    try {
      const [result] = await connection.query(
        "UPDATE `visitors` SET name = ?, address = ?, phone_number = ?, visit_date = ? WHERE id = ?",
        [name, address, phone_number, visit_date, id]
      );
      if (result.affectedRows > 0) {
        res.send({ message: "Visitor updated" });
      } else {
        res.status(404).send({ message: "Visitor not found" });
      }
    } catch (error) {
      res.status(500).send({ message: "Server error" });
    }
  });

  // Menghapus pengunjung
  app.delete("/visitors/:id", async (req, res) => {
    const id = req.params.id;
    try {
      const [result] = await connection.query(
        "DELETE FROM `visitors` WHERE id = ?",
        [id]
      );
      if (result.affectedRows > 0) {
        res.send({ message: "Visitor deleted" });
      } else {
        res.status(404).send({ message: "Visitor not found" });
      }
    } catch (error) {
      res.status(500).send({ message: "Server error" });
    }
  });

  app.listen(port, () =>
    console.log("Library Management API running on port 3005")
  );
})();
