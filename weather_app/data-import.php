<?php

// Connect to database
$sqli = new mysqli("localhost","root","");

mysqli_query($sqli, 'create database if not exists weatherapp');

mysqli_query($sqli, 'use weatherapp');


$url = 'https://api.openweathermap.org/data/2.5/weather?q=wycombe&appid=36bd7330103e2dbca2c20a5d99eea7cd&units=metric';

    // Get data from openweathermap and store in JSON object
    $data = file_get_contents($url);
    $json = json_decode($data, true);

    // Fetch required fields
    $icon = $json['weather'][0]['icon'];
    $weather_description = $json['weather'][0]['description'];
    $weather_temperature = $json['main']['temp'];
    $weather_wind = $json['wind']['speed'];
    $city = $json['name'];
    $pressure=$json['main']['pressure'];
    $humidity=$json['main']['humidity'];
    $deg=$json['wind']['deg'];

    echo $weather_description, $weather_temperature, $weather_wind, $city, $pressure, $humidity, $deg;

    //Building table
    mysqli_query($sqli, "create table if not exists weather(weather_description varchar(50), weather_temperature int(10), weather_wind int(10), city varchar(30), humidity int(10), pressure int(10), deg int(10), icon varchar(5));");

    // Build INSERT SQL 
    mysqli_query($sqli, "INSERT INTO weather (weather_description, weather_temperature, weather_wind, city, humidity, pressure, deg, icon)
    VALUES('$weather_description', $weather_temperature, $weather_wind, '$city','$humidity','$pressure','$deg', '$icon')");
