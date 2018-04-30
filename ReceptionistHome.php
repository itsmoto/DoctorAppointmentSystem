<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('receptionist');

$queryPerson = "select * from person,receptionist where person.email = receptionist.email and person.email='" . $_SESSION ['email'] . "'";
$getPerson = mysqli_query($conn, $queryPerson);
$person = mysqli_fetch_array($getPerson);
$firstName = $person ['fname'];
$lastName = $person ['lname'];
$receptionid = $person ['receptionid'];

$queryHist = "SELECT appointment.patientid, person.fname, person.lname, appointment.date, appointment.prescription, appointment.appid FROM appointment inner join patient on appointment.patientid=patient.patientid INNER JOIN person on patient.email=person.email ORDER BY appointment.date DESC";
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
                        <a href="ReceptionistHome.php">Home</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        <h3>WELCOME,<span><?php echo "$firstName $lastName (" . $_SESSION ['role'] . ")"; ?></span></h3>
                        <hr>
                    </div>
                    <div class="col-md-10">
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
                                    ?>
                                    <table  class='table table-responsive dataTable'>
                                        <thead><tr>
                                                <th>Patient</th>
                                                <th>Date</th>
                                                <th>Prescription</th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr></thead><tbody>
                                            <?php
                                            foreach ($hist as $app) {
                                                echo "<tr><td>$app[0] - $app[1] $app[2]</td><td>$app[3]</td><td>$app[4]</td>";
                                                $queryPayment = "select * from paymenthistory where appid=$app[5]";
                                                $getPayment = mysqli_query($conn, $queryPayment);
                                                $payment = mysqli_fetch_array($getPayment);
                                                $amount = $payment ['amount'];
                                                if ($amount != null) {
                                                    echo "<td>$amount</td>";
                                                } else {
                                                    ?>
                                        <td><form method="POST" action="record-payment.php?appId=<?=$app[5]?>">
                                                <input type='hidden' name="receptionid" value="<?=$receptionid  ?>">
                                                <input type='hidden' name="patientid" value="<?=$app[0] ?>">
                                                <input type='number' data-validation="number" data-validation-allowing="float" name="amount">&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class='btn btn-success'>Save</button>
                                            </form>
                                                    </td>
                                              <?php  }
                                                echo "<td><a href='ViewAppointment.php?appId=".$app[5]."' class='btn btn-primary'><i class='fa fa-eye'></i></a></td></tr>";
                                            }
                                            echo "</tbody></table>";
                                        } else {
                                            echo "<p>No appointment history</p>";
                                        }
                                        ?>

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
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
        <script  type="text/javascript">
            $(document).ready(function () {
                $('.dataTable').DataTable(
                        {
                            "order": [[1, "desc"]]
                        });
            });
        </script>
                        </body>

                        </html>
