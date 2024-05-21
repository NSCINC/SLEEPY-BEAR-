<?php
// Etapa 1: Conexão com o banco de dados
$servername = "localhost"; // ou endereço do servidor MySQL
$username = "seu_usuario_mysql";
$password = "sua_senha_mysql";
$database = "sleepy_bear";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Etapa 3: Lógica de autenticação
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Autenticação bem-sucedida
        session_start();
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // Redireciona para a página de boas-vindas
        exit;
    } else {
        $error = "Incorrect username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleepy Bear - Login</title>
    <style>
        /* Estilos CSS omitidos para brevidade */
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="app-title">Sleepy Bear - Login</h1>
        <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" class="input-field" placeholder="Username or Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-field" placeholder="Password">
            </div>
            <button type="submit" class="button">Login</button>
            <a href="registro.html" class="button">Register</a>
        </form>
    </div>
</body>
</html>

<?php
// Fechar conexão com o banco de dados
$conn->close();
?>
