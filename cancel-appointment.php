<?php
include './Connectivity.php';
if (empty ( $_SESSION ['email'] ))
	header ( 'Location:Login.php' );


$appId = $_REQUEST ["appId"];
$query = "DELETE FROM appointment WHERE appid = $appId";
$get = mysqli_query ( $conn, $query );
header ( 'Location: Home.php' );
?>