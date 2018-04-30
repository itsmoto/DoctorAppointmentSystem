<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('doctor');

$queryPerson = "select person.email, person.fname, person.lname, doctor.doctorid, doctor.specialization from person inner join doctor on person.email = doctor.email where person.email='" . $_SESSION ['email'] . "'";
$getPerson = mysqli_query($conn, $queryPerson);
$person = mysqli_fetch_array($getPerson);
$firstName = $person ['fname'];
$lastName = $person ['lname'];
$specialization = $person ['specialization'];
$docId = $person['doctorid'];

$startdate = isset($_GET['startdate'])?$_GET['startdate']:'1990-04-27';
$enddate = isset($_GET['enddate'])?$_GET['enddate']: '2400-04-27';
$queryHist = "SELECT appointment.appid, appointment.date, patient.patientid, person.fname, person.lname, appointment.prescription FROM appointment INNER JOIN patient on appointment.patientid = patient.patientid INNER JOIN person on patient.email= person.email WHERE appointment.doctorid=$docId and (appointment.date between '$startdate' and '$enddate') ORDER BY appointment.date DESC ";
$getHist = mysqli_query($conn, $queryHist);
$appHist = mysqli_fetch_all($getHist);
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
                        <a href="doctor-report.php">Doctor Report</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">Doctor Report 
                            </div>
                            <div class="card-body">
                                <form action="doctor-report.php" method="get">
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
                                            <th>Patient Name</th>
                                            <th>Prescription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($appHist as $app) {
                                          ?>
                                        <tr>
                                            <td><?=$app[1]?></td>
                                            <td><?= $app[3].' '. ($app[4])?></td>
                                            <td><?=$app[5]?></td>
                                           
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


