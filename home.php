<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}
if ($_SESSION ['role'] == 'doctor') {
        header('Location: DoctorHome.php');
    }
    if ($_SESSION ['role'] == 'receptionist') {
        header('Location: ReceptionistHome.php');
    }

$queryPerson = "select * from person where email='" . $_SESSION ['email'] . "'";
$getPerson = mysqli_query($conn, $queryPerson);
$person = mysqli_fetch_array($getPerson);
$firstName = $person ['fname'];
$lastName = $person ['lname'];

$queryPatient = "select * from patient where email='" . $_SESSION ['email'] . "'";
$getPatient = mysqli_query($conn, $queryPatient);
$patient = mysqli_fetch_array($getPatient);
$patientID = $patient ['patientid'];



$queryHistory = "SELECT appid, doctor.specialization, person.fname, person.lname, appointment.date, appointment.prescription, appointment.status FROM appointment inner join doctor on appointment.doctorid = doctor.doctorid inner JOIN person on doctor.email = person.email where patientid=$patientID ORDER BY appointment.date DESC";
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
                </ol>
                <div class="row">
                    <div class="col-12">
                        <h3>Welcome, <span><?php echo "$firstName $lastName (" . $_SESSION ['role'] . ")"; ?></span></h3>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">APPOINTMENT HISTORY</div>
                            <div class="card-body">
                                <div>
                                    <?php
                                    if (count($appHist) > 0) {
                                        echo "<br/>
							<div>
								<table class='table table-responsive table-bordered'>
									<thead>
                                                                        <tr>
										<th>Date</th>
										<th>Dr.</th>
										<th>Prescription</th>
                                                                                <th>Status</th>
										<th>View</th>
                                                                                <th>Cancel</th>
									</tr></thead><tbody>";

                                        foreach ($appHist as $app) {
                                            echo "<tr><td>$app[4]</td><td>Dr. $app[2] $app[3] ($app[1])</td><td>$app[5]</td><td>$app[6]</td>";
                                            echo "<td><a class='btn btn-primary' href='ViewAppointment.php?appId=" . $app [0] . "'>View</a></td>";
                                            echo "<td><a class='btn btn-danger' href='cancel-appointment.php?appId=" . $app [0] . "'>Cancel</a></td></tr>";
                                        }
                                        echo "
							</tbody></table>
							</div>";
                                    } else {
                                        echo "<p>No appointment history</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid-->
                <!-- /.content-wrapper-->

            </div>
            <?php
            include './includes/footer.php';
            ?>
        </div>
    </body>

</html>
