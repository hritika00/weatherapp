<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');

// Connect to database
$mysqli = new mysqli("localhost","root","");

//selecting database
mysqli_query($mysqli, 'use weatherapp');

//getting data from table
$result = mysqli_query($mysqli, 'select*from weather;');

//Get data, convert to JSON and print
$data= new stdClass;
while ($row = $result->fetch_assoc()) {
    $data = $row;
}

echo json_encode($data);