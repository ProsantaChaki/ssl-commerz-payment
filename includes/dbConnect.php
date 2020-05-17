<?php
$servername = "localhost";
$username = "root";
$password = "kajol1234";
$dbname = "sss-commerz";
$charset="utf8";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Cannot Connect to Database : " . $e->getMessage();
}
?>