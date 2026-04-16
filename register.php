<?php
include("includes/db.php");

$success = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // Hash password (VERY IMPORTANT)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){
        $error = "Email already registered!";
    } else {

        $query = "INSERT INTO users (name, email, password, location) 
                  VALUES ('$name', '$email', '$hashed_password', '$location')";

        if(mysqli_query($conn, $query)){
            $success = "Registration successful!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

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

        .register-box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #2e7d32;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2e7d32;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1b5e20;
        }

        .link {
            margin-top: 10px;
            display: block;
            font-size: 14px;
        }

        .message {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

<div class="register-box">
    <h2>🌽 Register</h2>

    <div class="message">
        <?php 
        if($success != "") echo "<p class='success'>$success</p>";
        if($error != "") echo "<p class='error'>$error</p>";
        ?>
    </div>

    <form method="POST">
    <input type="text" name="name" placeholder="Enter Name" required>
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <input type="text" name="location" placeholder="Enter Location" required>
    <button type="submit">Register</button>
</form>
    <a class="link" href="login.php">Already have an account? Login</a>
</div>

</body>
</html>