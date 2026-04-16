<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: login.php");
    exit();
}

$city = "London";

$apiKey = "76fd9bc7a15c181184a2beea1069fc03";

$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

$response = file_get_contents($url);
$data = json_decode($response,true);

$temp = $data['main']['temp'];
$humidity = $data['main']['humidity'];
$weather = $data['weather'][0]['description'];

$advice = "";

if($temp >= 20 && $temp <= 30){
    $advice = "Good temperature for maize planting.";
}
elseif($temp < 20){
    $advice = "Temperature is low. Delay planting maize.";
}
elseif($temp > 30){
    $advice = "Temperature is too high. Ensure irrigation.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maize Advisory</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background-color: #f4f4f4;
        }

        .header {
            background: #2e7d32;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 22px;
        }

        .container {
            width: 80%;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .weather-box p {
            font-size: 16px;
        }

        .advice {
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
        }

        .good {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 5px solid #2e7d32;
        }

        .warning {
            background: #fff8e1;
            color: #f57c00;
            border-left: 5px solid #f57c00;
        }

        .bad {
            background: #ffebee;
            color: #c62828;
            border-left: 5px solid #c62828;
        }

        input {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
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
    </style>
</head>

<body>

<div class="header">
    🌽 Maize Advisory System
</div>

<div class="container">

    <!-- CITY INPUT -->
    <div class="card">
        <form method="GET">
            <input type="text" name="city" placeholder="Enter your city">
            <button type="submit">Check</button>
        </form>
    </div>

    <!-- WEATHER DISPLAY -->
    <div class="card weather-box">
        <h3>Weather Information</h3>
        <p><strong>City:</strong> <?php echo $city; ?></p>
        <p><strong>Temperature:</strong> <?php echo $temp; ?> °C</p>
        <p><strong>Humidity:</strong> <?php echo $humidity; ?>%</p>
        <p><strong>Condition:</strong> <?php echo $weather; ?></p>
    </div>

    <!-- ADVISORY DISPLAY -->
    <div class="card">
        <h3>🌱 Maize Recommendation</h3>

        <?php
        $class = "";

        if (strpos($advice, "Good") !== false) {
            $class = "advice good";
        } elseif (strpos($advice, "too high") !== false || strpos($advice, "Low") !== false) {
            $class = "advice warning";
        } else {
            $class = "advice bad";
        }
        ?>

        <div class="<?php echo $class; ?>">
            <?php echo $advice; ?>
        </div>

    </div>

</div>
<a href="dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>