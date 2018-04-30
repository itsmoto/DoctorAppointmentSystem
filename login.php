<?php
include './Connectivity.php';
if (!empty($_SESSION ['email'])) {
    if ($_SESSION ['role'] == 'patient') {
        header('Location: Home.php');
    }
    if ($_SESSION ['role'] == 'doctor') {
        header('Location: DoctorHome.php');
    }
    if ($_SESSION ['role'] == 'receptionist') {
        header('Location: ReceptionistHome.php');
    }
    exit();
}

if (isset($_POST['btn'])) {
// checking the 'user' name which is from Sign-In.html, is it empty or have some text
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $query = mysqli_query($conn, "SELECT * FROM Login where email = '" . $user . "' AND password = '" . $pass . "'");
    if (!$query) {
        echo mysqli_error($conn);
    }
    $row = mysqli_fetch_array($query);

    if (mysqli_num_rows($query) > 0) {
        $_SESSION ['email'] = $row ['email'];
        $_SESSION ['role'] = $row ['role'];
        if ($_SESSION ['role'] == 'patient') {
            header('Location: Home.php');
        }
        if ($_SESSION ['role'] == 'doctor') {
            header('Location: DoctorHome.php');
        }
        if ($_SESSION ['role'] == 'receptionist') {
            header('Location: ReceptionistHome.php');
        }
        exit();
    } else {

        $_SESSION ['error_msg'] = "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Doctor Appointment System">
        <meta name="author" content="Doctor Appointment System">
        <link rel="shortcut icon" href="img/logo.jpg">
        <title>Doctor Appointment System</title>
        <!-- Bootstrap core CSS-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">
    </head>

    <body class="bg-dark">
        <div class="container">

            <div class="card card-register mx-auto mt-5">
            
                <h2 class="text-danger text-center"> <a href="index.php" style="color: red;">Doctor Appointment System</a></h2>
                <center> <a href="index.php"><img src="img/logo1.jpg" alt="" class="img-fluid"/></a></center>
                <div class="card-header">Login Into DAS</div>
                <div class="card-body">
                    <form  method="POST" action="login.php">
                        <div class="form-group">

                            <?php
                            if (isset($_SESSION['error_msg'])) {
                                echo '<div class="alert alert-danger">';
                                echo $_SESSION['error_msg'];
                                unset($_SESSION['error_msg']);
                                echo '</div>';
                            }
                            ?>

                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" required="" id="exampleInputEmail1" type="email" name="user" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control" required="" id="exampleInputPassword1" name="pass" type="password" placeholder="Password">
                        </div>          
                        <button type="submit" name="btn" class="btn btn-primary btn-block">Login</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    </body>

</html>
