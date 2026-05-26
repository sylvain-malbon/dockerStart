const express = require('express');
const mysql = require('mysql2/promise');

const app = express();
const port = process.env.PORT || 3000;

const dbConfig = {
  host: process.env.DB_HOST || 'database',
  port: Number(process.env.DB_PORT || 3306),
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || 'root',
  database: process.env.DB_NAME || 'projetdb',
};

app.use(express.json());

app.get('/', (req, res) => {
  res.json({
    message: 'Bienvenue sur l\'API du backend de votre projet Docker !',
  });
});

app.get('/api/status', async (req, res) => {
  let connection;

  try {
    connection = await mysql.createConnection(dbConfig);
    const [rows] = await connection.query('SELECT NOW() AS currentTime');

    res.json({
      status: 'success',
      database: 'connected',
      currentTime: rows[0].currentTime,
    });
  } catch (error) {
    res.status(500).json({
      status: 'error',
      database: 'unavailable',
      message: 'Database query failed',
      error: error.message,
    });
  } finally {
    if (connection) {
      await connection.end();
    }
  }
});

app.listen(port, () => {
  console.log(`Backend running on port ${port}`);
});