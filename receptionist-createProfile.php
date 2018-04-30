<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('receptionist');

$email = $_POST ['email'];
$fname = $_POST ['fname'];
$lname = $_POST ['lname'];
$userPassword = $_POST ['password'];
$confirm_password = $_POST ['confirm_password'];
$gender = $_POST ['gender'];
$phone = $_POST ['phone'];
$role = 'receptionist';
$date = $_POST ['date']; //birthday
$shift = $_POST ['shift'];
$streetaddress = $_POST ['address'];
$city = $_POST ['city'];

if($userPassword != $confirm_password){ // check if password match
    $_SESSION ['error_msg'] = "Passwords must match";
    header ( 'location: receptionist-registration.php' ); 
    exit();
}

$sql = "INSERT INTO person (city, dob, email,fname,gender,lname,role,streetaddress,phonenumber)
                VALUES ('$city', '$date', '$email','$fname','$gender','$lname','$role','$streetaddress','$phone') ";

$get = mysqli_query ( $conn, $sql );
if(!$get){
   $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: receptionist-registration.php' ); 
    exit(); 
}
$sql = "INSERT INTO login (email,password,role)
                VALUES ('$email','$userPassword','$role') ";

$get = mysqli_query ( $conn, $sql );
if(!$get){
    $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: receptionist-registration.php' ); 
    exit();
}

$sql = "INSERT INTO receptionist (email,shift)
                VALUES ('$email','$shift') ";
$get = mysqli_query ( $conn, $sql );
if(!$get){
    $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: receptionist-registration.php' ); 
    exit();
}


$_SESSION ['success_msg'] = "Account created";
header ( 'location: receptionist-registration.php' );

?>
