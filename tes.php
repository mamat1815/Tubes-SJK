<?php
session_start();

// Koneksi ke database
$server = "localhost";
$username = "admin";
$password = "23523023";
$database = "GATOT";


try {
    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    } else { echo "Koneksi berhasil"; }

    $error_message = '';
        
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Validasi user
        $stmt = $conn->prepare("SELECT password,idUsers FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        var_dump($stmt);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            if (password_verify($password, $row['password'])) {
                // Set sesi
                $_SESSION['username'] = $username;
                $_SESSION['idUsers'] = $row['idUsers'];
                header("Location: ../dashboard/dashboard.php");
                exit();
            } else {
                $error_message = "Password salah!";
            }
        } else {
            $error_message = "Username tidak ditemukan!";
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Cek koneksi





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <a href="register.php">Didn`t have an account? Sign In here</a>
        </form>
    </div>
</body>
</html>