<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('receptionist');


//record payment
$appid = $_GET['appId'];
$amount = $_POST['amount'];
$receptionid = $_POST['receptionid'];
$patientid= $_POST['patientid'];
$queryInsert = "INSERT INTO paymenthistory(appid,amount) values('$appid','$amount')";
$getPatient = mysqli_query($conn, $queryInsert);
if(!$getPatient){
   $_SESSION ['error_msg'] = mysqli_error($conn).'55';
    header ( 'location: ReceptionistHome.php' ); 
    exit(); 
}

//update the status
$queryInsert = "UPDATE  `appointment` SET  `status` =  'processing' WHERE  `appointment`.`appid` =$appid;";
$getPatient = mysqli_query($conn, $queryInsert);
if(!$getPatient){
   $_SESSION ['error_msg'] = mysqli_error($conn);
    header ( 'location: ReceptionistHome.php' ); 
    exit(); 
}

//send notification
    $querynotification = "INSERT INTO notifications(sender,receiver,message) values('$receptionid','$patientid','Your order has been processed, kindly check it out')";
    $getnotification = mysqli_query($conn, $querynotification);
    
    
$_SESSION['success_msg'] = 'Payment recorded';
header('Location: ReceptionistHome.php');
exit();

