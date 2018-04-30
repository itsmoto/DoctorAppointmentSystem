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

$queryT = "select count(*) as total from appointment where  appointment.doctorid ='" .$docId . "'";
$getT = mysqli_query($conn, $queryT);
$row = mysqli_fetch_array($getT);
$total = $row ['total'];


$queryHist = "SELECT appointment.appid, appointment.date, patient.patientid, person.fname, person.lname, appointment.prescription, appointment.time FROM appointment INNER JOIN patient on appointment.patientid = patient.patientid INNER JOIN person on patient.email= person.email WHERE appointment.doctorid=$docId  ORDER BY appointment.date DESC ";
$getHist = mysqli_query($conn, $queryHist);
$hist = mysqli_fetch_all($getHist);
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
                        <a href="DoctorHome.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="DoctorHome.php">Doctor Home</a>
                    </li>
                </ol>
               
                <div class="row">
                    <div class="col-12">
                        <h3>WELCOME, <span><?php echo "$firstName $lastName (" . $_SESSION ['role'] . ")"; ?></span></h3>
                        <hr>
                    </div>
                     <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">You have <?= $total?> appointments</div>
                        </div>
                       
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">APPOINTMENT HISTORY</div>
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

                                <?php
                                if (count($hist) > 0) {
                                    echo "
							<table class='table dataTable'>
									<thead><tr>
										<th>Date</th>
                                                                                <th>Time</th>
										<th>Patient</th>
										<th>Prescription</th>
									</tr></thead><tbody>";

                                    foreach ($hist as $app) {
                                        echo "<tr><td>$app[1]</td><td>$app[6]</td><td>$app[3] $app[4]</td>";
                                        if ($app[5]) {
                                            echo "<td>$app[5]</td>";
                                        } else {
                                            ?>
                                            <td><form method="POST" action="record-prescription.php?appId=<?= $app[0] ?>">
                                                    <input type='hidden' name="doctorid" value="<?=$docId ?>">
                                                    <input type='hidden' name="patientid" value="<?=$app[2] ?>">
                                                    <input type='text' name="prescription">&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class='btn btn-success'>Save</button>
                                                </form>
                                            </td>
                                            <?php
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</tbody></table>";
                                } else {
                                    echo "<p>No appointment history</p>";
                                }
                                ?>
                            </div>
                        </div></div>
                </div>
            </div>
            <!-- /.container-fluid-->
            <!-- /.content-wrapper-->
            <?php
            include './includes/footer.php';
            ?>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
        <script  type="text/javascript">
            $(document).ready(function () {
                $('.dataTable').DataTable(
                        {
                            "order": [[0, "desc"]]
                        });
            });
        </script>
    </body>

</html>
