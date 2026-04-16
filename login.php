<?php
session_start();
include("includes/db.php");

$error = "";
$email = "";

// CHECK DB CONNECTION
if (!$conn) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CLEAN INPUT
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    // CHECK USER
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // VERIFY PASSWORD
        if (password_verify($password, $row['password'])) {

            // SET SESSION
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Incorrect password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(to right, #2e7d32, #66bb6a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 30px;
            width: 340px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #2e7d32;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2e7d32;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #1b5e20;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .link {
            margin-top: 12px;
            display: block;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>🌽 Login</h2>

    <?php 
    if($error != "") {
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST" autocomplete="off">

        <input 
            type="email" 
            name="email" 
            placeholder="Enter Email" 
            required 
            value="<?php echo htmlspecialchars($email); ?>"
            autocomplete="off"
        >

        <input 
            type="password" 
            name="password" 
            placeholder="Enter Password" 
            required 
            autocomplete="new-password"
        >

        <button type="submit">Login</button>

    </form>

    <a class="link" href="register.php">Don't have an account? Register</a>
</div>

</body>
</html>