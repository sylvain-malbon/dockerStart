require('dotenv').config();
const express = require('express');
const mysql = require('mysql2/promise');

const app = express();
const port = process.env.BACKEND_PORT || 3000;

// Route GET /
app.get('/', (req, res) => {
  res.json({ message: 'Hello from backend - watch test ultime' });
});

// Route GET /db-test
app.get('/db-test', async (req, res) => {
  try {
    const connection = await mysql.createConnection({
      host: process.env.DB_HOST || 'localhost',
      user: process.env.MYSQL_USER || 'root',
      password: process.env.MYSQL_PASSWORD || '',
      database: process.env.MYSQL_DATABASE || 'test',
      port: process.env.DB_PORT || 3306,
    });
    await connection.ping();
    await connection.end();
    res.json({ db: 'Connexion MySQL OK' });
  } catch (err) {
    res.status(500).json({ db: 'Erreur connexion MySQL', error: err.message });
  }
});

app.listen(port, () => {
  console.log(`Backend listening on port ${port}`);
});