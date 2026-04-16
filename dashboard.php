<?php
session_start();

// CHECK IF USER IS LOGGED IN
if(!isset($_SESSION['name'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Farmer Dashboard</title>

<style>
body{
    font-family: Arial;
    background:#f2f2f2;
    margin:0;
}

.header{
    background:#2e7d32;
    color:white;
    padding:20px;
    text-align:center;
}

.container{
    width:80%;
    margin:auto;
    margin-top:30px;

    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:25px;
}

.card{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0px 4px 10px rgba(0,0,0,0.1);
    text-align:center;
    transition:0.3s;
}

.card:hover{
    transform: scale(1.05);
}

.card h3{
    margin-bottom:10px;
}

.card p{
    font-size:14px;
    color:#555;
}

.card a{
    text-decoration:none;
    color:white;
    background:#2e7d32;
    padding:10px 15px;
    border-radius:5px;
    display:inline-block;
    margin-top:10px;
}

.card a:hover{
    background:#1b5e20;
}

.logout{
    text-align:center;
    margin-top:40px;
}

.logout a{
    text-decoration:none;
    color:white;
    background:#c62828;
    padding:10px 20px;
    border-radius:5px;
}

.logout a:hover{
    background:#8e0000;
}
</style>

</head>

<body>

<div class="header">
    <h2>🌽 Crop Planning Advisory System</h2>
    <p>Welcome, <?php echo $_SESSION['name']; ?> 👋</p>
</div>

<div class="container">

    <div class="card">
        <h3>🌦 Weather Forecast</h3>
        <p>Check current weather conditions.</p>
        <a href="weather.php">Open</a>
    </div>

    <div class="card">
        <h3>🌱 Crop Advisory</h3>
        <p>Get maize planting recommendations.</p>
        <a href="advisory.php">Open</a>
    </div>

    <div class="card">
        <h3>📅 Planting Calendar</h3>
        <p>View the maize farming schedule.</p>
        <a href="calendar.php">Open</a>
    </div>

    <div class="card">
        <h3>📊 Weather Charts</h3>
        <p>View weather statistics graphically.</p>
        <a href="weather_chart.php">Open</a>
    </div>

</div>

<div class="logout">
    <a href="logout.php">Logout</a>
</div>

</body>
</html>