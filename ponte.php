<?php
session_start();

// Verifica se a autenticação foi bem-sucedida (você pode substituir esta condição pela sua lógica real)
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // Redireciona para o arquivo de login
    header("Location: login.php");
    exit; // Termina o script para garantir que o redirecionamento seja executado
} else {
    // Se não estiver autenticado, redireciona de volta para o arquivo de autenticação
    header("Location: auth.html ");
    exit; // Termina o script para garantir que o redirecionamento seja executado
}
?>

