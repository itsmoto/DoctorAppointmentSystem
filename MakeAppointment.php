<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('patient');

//get current user id
$queryPatient = "select * from patient where email='" . $_SESSION ['email'] . "'";
$getPatient = mysqli_query($conn, $queryPatient);
$patient = mysqli_fetch_array($getPatient);
$patientID = $patient ['patientid'];

$querySpecialization = 'select * from doctor, person where doctor.email = person.email';
$getDoctor = mysqli_query($conn, $querySpecialization);

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    
    $date = $_POST ["date"];
    $time = $_POST ["time"];
    $doctorid = $_POST ["doctorid"];
    
    
    //send notification
    $querynotification = "INSERT INTO notifications(sender,receiver,message) values('$patientID','$doctorid','You have a new appointment, kindly check it out')";
    $getnotification = mysqli_query($conn, $querynotification);
    
    //make appointment
    $queryInsert = "INSERT INTO appointment(patientid,doctorid,date,time) values('$patientID','$doctorid','$date','$time')";
    $getPatient = mysqli_query($conn, $queryInsert);
    if($getPatient){
        $_SESSION['success_msg'] = 'Appoiment booked';
    }
    header('Location: MakeAppointment.php');
    exit();
}
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
                        <a href="MakeAppointment.php">MAKE AN APPOINTMENT</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        <h1>Kindly make your appointment,<span><?php echo "(" . $_SESSION ['role'] . ")"; ?></span></h1>
                        <hr>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header">MAKE AN APPOINTMENT</div>
                            
                            <div class="card-body">
                                                <?php
                                    if (isset($_SESSION['error_msg'])) {
                                        echo '<div class="alert alert-danger">';
                                        echo $_SESSION['error_msg'];
                                        unset($_SESSION['error_msg']);
                                        echo '</div>';
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['success_msg'])) {
                                        echo '<div class="alert alert-success">';
                                        echo $_SESSION['success_msg'];
                                        unset($_SESSION['success_msg']);
                                        echo '</div>';
                                    }
                                    ?>
                                            <form class="form-horizontal" action="MakeAppointment.php" method="post" name="appt">
                                             
                                                    <div class="form-group">
                                                        <label><b>Select Doctor:</b></label>
                                                        <select name="doctorid" class="form-control" id="spec" onchange="AjaxFunctionForDoctor()" required="required">
                                                                <option value="" selected="selected">---Select---</option>			
                                                                <?php
                                                                while ($row = mysqli_fetch_array($getDoctor)) {
                                                                   
                                                                    echo '<option value="' .  $row ['doctorid']. '" >' .  $row ['fname'].' '. $row ['lname'].' ('. $row ['specialization'].  ')</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label><b>Select Date</b></label>
                                                        <input type="date" class="form-control datepicker" name="date" id="date"required="required" placeholder="yyyy/mm/dd">
                                                    </div>
                                                    <div class="form-group">
                                                        <label><b> Select Time</b></label>
                                                                <select name="time" id="time" class="form-control" required="required">
                                                                
                                                                <option value="">---Select Time---</option>
                                                                <option value="08:00:00">08:00:00</option>
                                                                <option value="09:00:00">09:00:00</option>
                                                                <option value="10:00:00">10:00:00</option>
                                                                <option value="11:00:00">11:00:00</option>
                                                                <option value="12:00:00">12:00:00</option>
                                                                <option value="13:00:00">13:00:00</option>
                                                                <option value="14:00:00">14:00:00</option>
                                                                <option value="15:00:00">15:00:00</option>
                                                                <option value="16:00:00">16:00:00</option>
                                                                <option value="17:00:00">17:00:00</option>
                                                                <option value="18:00:00">18:00:00</option>
                                                            </select>
                                                       </div>
                                                    
                                                    <button type="submit" class="btn btn-primary" name="book">Book the Appointment</button>
                                    </form>                                      
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
   <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">

<script src="js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    zIndexOffset:9999,
    todayHighlight: true,
    todayBtn: true
});
});
    </script>
    </body>

</html>
