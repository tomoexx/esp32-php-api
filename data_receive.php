<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "PHP working but no POST";
    exit;
}

$api_key = $_POST["esp_api_key"] ?? "";
$temp    = $_POST["esp_temp"] ?? "";
$humid   = $_POST["esp_humid"] ?? "";

if ($api_key !== "123456899") {
    echo "Invalid API Key";
    exit;
}

$conn = new mysqli(
    getenv("MYSQLHOST"),
    getenv("MYSQLUSER"),
    getenv("MYSQLPASSWORD"),
    getenv("MYSQLDATABASE"),
    getenv("MYSQLPORT")
);

if ($conn->connect_error) {
    die("Database connection failed");
}

$sql = "INSERT INTO sensor_data (temperature, humidity)
        VALUES ('$temp', '$humid')";

if ($conn->query($sql)) {
    echo "Insert OK";
} else {
    echo "Insert Fail";
}

$conn->close();
