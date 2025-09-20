<?php
session_start();
require_once("@connect.php");
if (isset($_POST['registerBtn']))
{
    $email = $_POST['email'];
    $name = $_POST['name'];
    $class = $_POST['class'];

    $checkAccount = $conn -> query("SELECT email FROM users WHERE email = '$email'");

    if ($checkAccount -> num_rows > 0)
    {
        $_SESSION['acc_found'] = "Tài khoản đã tồn tại";   
        $_SESSION['active_form'] = 'registerBox';
    }
    else
    {
        $conn -> query("INSERT INTO users (email, name, class) VALUES ('$email', '$name', '$class')");
        $_SESSION['active_form'] = 'searchBox';;
    }
    header("Location: index.php");
    exit();
}


//search
if (isset($_POST['searchBtn']))
{
    $search = $_POST['search'];
    $sqlSearch = "SELECT * FROM users WHERE `name` LIKE '%$search%' OR email LIKE '%$search%' OR class LIKE '%$search%'";
    $result = $conn -> query($sqlSearch);

    if ($result -> num_rows > 0)
    {   
        $_SESSION['print'] = [];
        while($row = $result -> fetch_assoc())
        {
            $_SESSION['active_form'] = 'searchBox';
            $_SESSION['print'][] = "Tên: " . $row['name'] . " | " . "Lớp: " . $row['class'] . " | " ."Email: " . $row['email'] . "<br>";
        }
    }
    else
        {
        $_SESSION['active_form'] = 'searchBox';
        $_SESSION['acc_not_found'] = "Không tìm thấy tài khoản";
    }
    header("Location: index.php");
    exit();
}