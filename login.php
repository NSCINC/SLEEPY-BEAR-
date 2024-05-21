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

        // Simulação de autenticação (substitua por sua lógica real)
        if ($email === "example@example.com" && $password === "password123") {
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
        <input type="submit" value="Login"><?php
// Database connection
$db = new SQLite3('users.db');

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$code = $data['code'];

// Check the verification code
$stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND code = :code");
$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$stmt->bindValue(':code', $code, SQLITE3_INTEGER);
$result = $stmt->execute()->fetchArray();

if ($result) {
    $response = ['success' => true];
} else {
    $response = ['success' => false];
}

echo json_encode($response);
?>

    </form>
<?php } ?>
</body>
</html>
