<?php
// Conexão ao banco de dados SQLite
$db = new SQLite3('users.db');

// Criação da tabela de usuários
$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    code INTEGER
)";
$db->exec($query);

echo "Database initialized.";
?>
