<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "doctorappointmentsystem";

$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function role($role) {
    if ($_SESSION ['role'] != $role) {
    header('Location: 403.php');
}
}
?>

