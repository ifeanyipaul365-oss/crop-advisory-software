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
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>Weather Chart</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<h2>Weather Data Chart</h2>

<canvas id="weatherChart" width="400" height="200"></canvas>

<script>

var ctx = document.getElementById('weatherChart').getContext('2d');

var chart = new Chart(ctx, {
type: 'bar',

data: {
labels: ['Temperature', 'Humidity'],

datasets: [{
label: 'Weather Data',

data: [<?php echo $temp; ?>, <?php echo $humidity; ?>],

backgroundColor: [
'rgba(255, 99, 132, 0.5)',
'rgba(54, 162, 235, 0.5)'
]

}]
}

});

</script>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>