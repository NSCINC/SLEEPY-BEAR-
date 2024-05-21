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

// Inserir um usuário de exemplo (para testes)
$email = "example@example.com";
$password = "password123";
$code = 1234; // Código de exemplo

$stmt = $db->prepare("INSERT INTO users (email, password, code) VALUES (:email, :password, :code)");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':password', $password, SQLITE3_TEXT);
$stmt->bindValue(':code', $code, SQLITE3_INTEGER);
$stmt->execute();

echo "Database initialized and sample user added.";
?>
