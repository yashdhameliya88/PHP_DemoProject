<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    $query = "INSERT INTO users (username, password, email, full_name) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssss", $username, $password, $email, $full_name);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="full_name" placeholder="Full Name"><br>
            <button type="submit">Register</button>
            <br><br><a href="login.php">Login</a> <br>If you already have an account.
        </form>
    </div>
</body>
</html>
