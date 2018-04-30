<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('receptionist');

$queryPerson = "select * from person";
$getPerson = mysqli_query($conn, $queryPerson);
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
                        <a href="user-list.php">Users' List</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">Users' List <div class="pull-right"><a href="doctor-registration.php" class="btn btn-primary"><i class="fa fa-plus"></i> Doctor</a> <a href="receptionist-registration.php" class="btn btn-success"><i class="fa fa-plus"></i> Receptionist</a></div></div>
                            <div class="card-body">
                                <table class="table dataTable">
                                    <thead>
                                        <tr><th>Id</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Phone Number</th>
                                            <th>dob</th>
                                            <th>City</th>
                                            <th>Role</th>
                                            <th>Street</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $id = 1;
                                        while ($row = mysqli_fetch_array($getPerson)) {
                                          ?>
                                        <tr><td><?=$id?></td>
                                            <td><?=$row['email']?></td>
                                            <td><?=$row['fname']?> <?=$row['lname']?></td>
                                            <td><?=$row['gender']?></td>
                                            <td><?=$row['phonenumber']?></td>
                                            <td><?=$row['dob']?></td>
                                            <td><?=$row['city']?></td>
                                            <td><?=$row['role']?></td>
                                            <td><?=$row['streetaddress']?></td>
                                            
                                        </tr>
                                        <?php $id++;
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
        ]
    });
});
  </script>
    </body>

</html>


