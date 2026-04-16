<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Weather Forecast</title>

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
}

.card{
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 4px 10px rgba(0,0,0,0.1);
    text-align:center;
}

input{
    width:60%;
    padding:12px;
    margin-top:15px;
    border-radius:5px;
    border:1px solid #ccc;
}

button{
    padding:12px 20px;
    background:#2e7d32;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    margin-left:10px;
}

button:hover{
    background:#1b5e20;
}

.result{
    margin-top:20px;
    font-size:18px;
}

.back{
    margin-top:30px;
    text-align:center;
}

.back a{
    text-decoration:none;
    background:#555;
    color:white;
    padding:10px 20px;
    border-radius:5px;
}

.back a:hover{
    background:#333;
}
</style>

</head>

<body>

<div class="header">
    <h2>🌦 Weather Forecast</h2>
    <p>Welcome, <?php echo $_SESSION['name']; ?> 👋</p>
</div>

<div class="container">

    <div class="card">

        <h3>Check Weather</h3>

        <form method="POST">
            <input type="text" name="city" placeholder="Enter city (e.g. Lagos)" required>
            <button type="submit">Get Weather</button>
        </form>

        <div class="result">
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $city = $_POST['city'];

            // 🔑 INSERT YOUR API KEY HERE
            $apiKey = "76fd9bc7a15c181184a2beea1069fc03";

            $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$apiKey."&units=metric";

            $response = @file_get_contents($url);

            if($response === FALSE){
                echo "Unable to fetch weather data. Check API key or internet.";
            } else {

                $data = json_decode($response, true);

                if($data["cod"] == 200){

                    $temp = $data["main"]["temp"];
                    $weather = $data["weather"][0]["description"];
                    $humidity = $data["main"]["humidity"];

                    echo "<b>$city</b><br>";
                    echo "🌡 Temperature: $temp °C<br>";
                    echo "☁ Condition: $weather<br>";
                    echo "💧 Humidity: $humidity%";

                } else {
                    echo "City not found!";
                }
            }
        }
        ?>
        </div>

    </div>

</div>

<div class="back">
    <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>