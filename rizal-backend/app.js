const express = require('express');
const mysql = require('mysql2/promise');
const data = require('./example-data.json');
const cors = require('cors');

const port = 7014;

(async () => {
  const app = express();

  app.use(cors());

  const connection = await mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'my_db',
  });

  connection.connect((err) => {
    if (err) {
      console.error('error connecting: ' + err.stack);
      return;
    }
    console.log('connected as id ' + connection.threadId);
  });

  app.use(express.json());

  app.get('/api/users', async (req, res) => {
    try {
      const [results, fields] = await connection.query('SELECT * FROM `users`');

      res.json({
        data: {
          results,
        },
        message: 'Users retrieved successfully',
      });
    } catch (error) {
      res.status(500).send({ message: 'Server error' });
    }
  });

app.get('/users/:id', async (req, res) => {
  const id = req.params.id;
  
  try {
    const [results, fields] = await connection.query('SELECT * FROM `users` WHERE id = ?', [id]);

    if (results.length > 0) {
      res.json(results[0]);
    } else {
      res.status(404).send({ message: 'User not found' });
    }
  } catch (error) {
    res.status(500).send({ message: 'Server error' });
  }
});

app.post('/users', async (req, res) => {
  const { name, email } = req.body;

  try {
    const [result] = await connection.query('INSERT INTO `users` (name, email) VALUES (?, ?)', [name, email]);

    res.status(201).send({
      message: 'User created',
      data: {
        id: result.insertId,
        name,
        email,
      },
    });
  } catch (error) {
    res.status(500).send({ message: 'Server error' });
  }
});

app.patch('/users/:id', async (req, res) => {
  const id = req.params.id;
  const { name, email } = req.body;

  try {
    const [result] = await connection.query(
      'UPDATE `users` SET name = ?, email = ? WHERE id = ?',
      [name, email, id]
    );

    if (result.affectedRows > 0) {
      res.send({ message: 'User updated' });
    } else {
      res.status(404).send({ message: 'User not found' });
    }
  } catch (error) {
    res.status(500).send({ message: 'Server error' });
  }
});  

  app.delete('/users/:id', async (req, res) => {
  const id = req.params.id;

  try {
    const [result] = await connection.query('DELETE FROM `users` WHERE id = ?', [id]);

    if (result.affectedRows > 0) {
      res.send({ message: 'User deleted' });
    } else {
      res.status(404).send({ message: 'User not found' });
    }
  } catch (error) {
    res.status(500).send({ message: 'Server error' });
  }
});

  app.listen(port, () => console.log('Listening on port 3003'));
})();

