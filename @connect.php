<?php
$host = "localhost";
$user = "root";
$pass = "123456789";
$database = "studentmanagement";

$conn = new mysqli($host, $user, $pass, $database);

if ($conn -> connect_error)
{
    die("connection loss" . $conn -> connect_error);
}