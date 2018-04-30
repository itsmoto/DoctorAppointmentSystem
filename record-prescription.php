<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('doctor');

//record payment
$appid = $_GET['appId'];
$prescription = $_POST['prescription'];
$doctorid = $_POST['doctorid'];
$patientid= $_POST['patientid'];
$queryInsert = "UPDATE  `appointment` SET  `prescription` =  '$prescription' WHERE  `appointment`.`appid` =$appid;";
$getPatient = mysqli_query($conn, $queryInsert);
if(!$getPatient){
   $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: DoctorHome.php' ); 
    exit(); 
}

//update the status
$queryInsert = "UPDATE  `appointment` SET  `status` =  'completed' WHERE  `appointment`.`appid` =$appid;";
$getPatient = mysqli_query($conn, $queryInsert);
if(!$getPatient){
   $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: DoctorHome.php' ); 
    exit(); 
}

//send notification
    $querynotification = "INSERT INTO notifications(sender,receiver,message) values('$doctorid','$patientid','You have a comment from doctor, kindly check it out')";
    $getnotification = mysqli_query($conn, $querynotification);

$_SESSION['success_msg'] = 'Prescription recorded';
header('Location: DoctorHome.php');
exit();

