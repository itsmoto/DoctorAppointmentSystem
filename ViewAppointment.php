<?php
include './Connectivity.php';
if (empty($_SESSION ['email']))
    header('Location: login.php');

$appId = mysqli_real_escape_string($conn,$_GET['appId']);
$querySpecialization = "select * from appointment where appid=$appId";
$getSpecialization = mysqli_query($conn, $querySpecialization);
$g = mysqli_fetch_array($getSpecialization);
$date = $g ['date'];
$time = substr($g ['time'], 0, 5);
$prescription = $g ['prescription'];
$patientId = $g ['patientid'];
$doctorId = $g ['doctorid'];
$status = $g ['status'];

$querySpecialization = "select * from doctor inner join person on doctor.email=person.email where doctorid = '$doctorId'";
$getSpecialization = mysqli_query($conn, $querySpecialization);
$g = mysqli_fetch_array($getSpecialization);
$drName = "Dr." . $g ['fname'] . " " . $g ['lname'];
$specialization = $g ['specialization'];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include 'includes/head_tag.php' ?>
    </head>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <!-- Navigation-->
        <?php include 'includes/header.php' ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="home.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="ViewAppointment.php?appId=<?= $appId ?>">View Appointment</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">View Appointment</div>

                            <div class="card-body">


                                <div class="form-group">
                                    <label><b>Doctor Name:</b></label>
                                    <?= $drName ?>
                                </div>
                                <div class="form-group">
                                    <label><b>Specialization:</b></label>
                                    <?= $specialization ?>
                                </div>

                                <div class="form-group">
                                    <label><b>Date: </b></label>
                                    <?= $date ?>
                                </div>
                                <div class="form-group">
                                    <label><b>Time:</b></label>
                                    <?= $time ?>
                                </div>
                                <div class="form-group">
                                    <label><b> Status:</b></label>
                                    <label class="text-info"><?= $status ?></label>
                                </div>
                                <div class="form-group">
                                    <label><b> Amount to be Paid:</b></label>
                                    <?php
                                $queryPayment = "select * from paymenthistory where appid=$appId";
                                $getPayment = mysqli_query($conn, $queryPayment);
                                $payment = mysqli_fetch_array($getPayment);
                                $amount = $payment ['amount'];
                                if ($amount) {
                                    echo "<td>".number_format($amount)."/=</td>";
                                } else {
                                    echo 'Not Processed';
                                }
                                ?>
                                </div>
                                <div class="form-group">
                                    <label><b> Prescription:</b></label>
                                    <?= $prescription ?>
                                </div>
                                



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid-->
            <!-- /.content-wrapper-->
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin.min.js"></script>

    </body>

</html>
