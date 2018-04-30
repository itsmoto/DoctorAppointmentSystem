<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
}

//check the right role/person to view this page.
role('doctor');

    $get_docid = mysqli_fetch_array ( mysqli_query ( $conn, "Select doctorid from doctor where email='".$_SESSION['email']."'" ) );
    $docid = $get_docid ["doctorid"];
    
    $queryPerson = "select * from notifications where receiver = '$docid' order by id desc";
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
                        <a href="doctor-notifications.php">Notifications</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header"> <i class="fa fa-fw fa-bell-o"></i> Notifications 
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Message</th>
                                             <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($getPerson)) {
                                          ?>
                                        <tr>
                                            <td><?=$row['id']?></td>
                                            <td><?=$row['message']?> (<?=$row['time']?>)</td>
                                            
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
    </body>

</html>


