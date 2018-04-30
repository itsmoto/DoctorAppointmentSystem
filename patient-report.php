<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('patient');


$queryPerson = "select * from person where email='" . $_SESSION ['email'] . "'";
$getPerson = mysqli_query($conn, $queryPerson);
$person = mysqli_fetch_array($getPerson);
$firstName = $person ['fname'];
$lastName = $person ['lname'];

$queryPatient = "select * from patient where email='" . $_SESSION ['email'] . "'";
$getPatient = mysqli_query($conn, $queryPatient);
$patient = mysqli_fetch_array($getPatient);
$patientID = $patient ['patientid'];


 $startdate = isset($_GET['startdate'])?$_GET['startdate']:'1990-04-27';
 $enddate = isset($_GET['enddate'])?$_GET['enddate']: '2400-04-27';
$queryHistory = "SELECT appid, doctor.specialization, person.fname, person.lname, appointment.date, appointment.prescription, appointment.status FROM appointment inner join doctor on appointment.doctorid = doctor.doctorid inner JOIN person on doctor.email = person.email where patientid=$patientID and (appointment.date between '$startdate' and '$enddate') ORDER BY appointment.date DESC";
$getAppHist = mysqli_query($conn, $queryHistory);
$appHist = null;
if ($getAppHist) {
    $appHist = mysqli_fetch_all($getAppHist);
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
                        <a href="patient-report.php">Report</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">Report 
                            </div>
                            <div class="card-body">
                                <form action="patient-report.php" method="get">
                                 <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="exampleInputName">Start date</label>
                                                <input class="form-control" required="" id="exampleInputName" type="date"name="startdate" aria-describedby="startdate" placeholder="Start date">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputLastName">End date</label>
                                                <input class="form-control" required=""  id="exampleInputLastName" type="date" name="enddate"aria-describedby="enddate" placeholder="End date<">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputLastName"></label><br>
                                                <button style="margin-top: 9px;" type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                
                                <table class="table dataTable">
                                    <thead>
                                        <tr>
                                           <th>Date</th>
                                            <th>Dr. Name</th>
                                            <th>Prescription</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($appHist as $app) {
                                          ?>
                                        <tr>
                                            <td><?=$app[4]?></td>
                                            <td><?= $app[3].' '. ($app[1])?></td>
                                            <td><?=$app[5]?></td>
                                            <td><?=$app[6]?></td>
                                           
                                        </tr>
                                        <?php
                                        }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <!-- /.container-fluid-->
            <!-- /.content-wrapper-->
            <?php
            include './includes/footer.php';
            ?>
        </div>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <script  type="text/javascript">
  $(document).ready( function () {
    $('.dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        "order": [[0, "desc"]]
    });
});
  </script>
    </body>

</html>


