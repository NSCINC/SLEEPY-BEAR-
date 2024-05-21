<?php
header('Content-Type: application/json');

// Recebe os dados do formulário
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['code'], $data['email'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    exit;
}

$code = $data['code'];
$email = $data['email'];
$password = $data['password'];

// Conexão ao banco de dados SQLite
$db = new SQLite3('users.db');

// Verifica se o email já está registrado
$stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$result = $stmt->execute()->fetchArray();

if ($result) {
    echo json_encode(['success' => false, 'message' => 'Email already registered']);
    exit;
}

// Insere o novo usuário no banco de dados com o código de verificação
$stmt = $db->prepare("INSERT INTO users (email, password, code) VALUES (:email, :password, :code)");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':password', $password, SQLITE3_TEXT);
$stmt->bindValue(':code', $code, SQLITE3_INTEGER);
$stmt->execute();

echo json_encode(['success' => true]);
?>
