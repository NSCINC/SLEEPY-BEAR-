<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sleepy Bear</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Conexão ao banco de dados SQLite
        $db = new SQLite3('users.db');

        // Verificação do email e senha no banco de dados
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray();

        if ($result) {
            echo "<h1>Login Successful</h1>";
            echo "<p>Welcome to Sleepy Bear!</p>";
        } else {
            echo "<h1>Login Failed</h1>";
            echo "<p>Incorrect email or password. Please try again.</p>";
        }
    }
} else {
?>
    <h1>Login - Sleepy Bear</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
<?php } ?>
</body>
</html>
