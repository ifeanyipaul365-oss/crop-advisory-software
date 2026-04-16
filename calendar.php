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
<title>Planting Calendar</title>

<style>

body{
font-family: Arial;
background:#f4f4f4;
}

table{
width:60%;
margin:auto;
border-collapse:collapse;
background:white;
}

th,td{
border:1px solid #ccc;
padding:10px;
text-align:center;
}

th{
background:#4CAF50;
color:white;
}

</style>

</head>

<body>

<h2 style="text-align:center;">Maize Planting Calendar</h2>

<table>

<tr>
<th>Month</th>
<th>Activity</th>
</tr>

<tr>
<td>March</td>
<td>Land preparation</td>
</tr>

<tr>
<td>April</td>
<td>Plant maize seeds</td>
</tr>

<tr>
<td>May</td>
<td>Apply fertilizer</td>
</tr>

<tr>
<td>June</td>
<td>Weeding and pest monitoring</td>
</tr>

<tr>
<td>July</td>
<td>Crop growth monitoring</td>
</tr>

<tr>
<td>August</td>
<td>Harvest preparation</td>
</tr>

</table>

<br>

<div style="text-align:center;">
<a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>