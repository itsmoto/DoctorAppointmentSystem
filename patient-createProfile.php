<?php
include './Connectivity.php';




$email = $_POST ['email'];
$fname = $_POST ['fname'];
$lname = $_POST ['lname'];
$userPassword = $_POST ['password'];
$confirm_password = $_POST ['confirm_password'];
$gender = $_POST ['gender'];
$phone = $_POST ['phone'];
$role = 'patient';
$date = $_POST ['date'];
$streetaddress = $_POST ['address'];
$city = $_POST ['city'];

if($userPassword != $confirm_password){ // check if password match
    $_SESSION ['error_msg'] = "Passwords must match";
    header ( 'location: patient-registration.php' ); 
    exit();
}


$sql = "INSERT INTO person (city, dob, email,fname,gender,lname,role,streetaddress,phonenumber)
                VALUES ('$city', '$date', '$email','$fname','$gender','$lname','$role','$streetaddress','$phone') ";

$get = mysqli_query ( $conn, $sql );
if(!$get){
   $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: patient-registration.php' ); 
    exit(); 
}
$sql = "INSERT INTO login (email,password,role)
                VALUES ('$email','$userPassword','$role') ";

$get = mysqli_query ( $conn, $sql );
if(!$get){
    $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: patient-registration.php' ); 
    exit();
}


$_SESSION ['success_msg'] = "Account created, now <a href='login.php'>login here</a>";
header ( 'location: patient-registration.php' );

?>
