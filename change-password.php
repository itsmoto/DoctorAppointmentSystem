<?php
include './Connectivity.php';
if(isset($_POST['btn'])){
    $userPassword = $_POST ['password'];
    $confirm_password = $_POST ['confirm_password'];
    $email = $_SESSION ['email'];
if ($userPassword != $confirm_password) { // check if password match
    $_SESSION ['error_msg'] = "Passwords must match";
    header('location: change-password.php');
    exit();
}


$sql = "UPDATE `login` SET  `password` =  '$userPassword' WHERE  `login`.`email` =  '$email';";

$get = mysqli_query($conn, $sql);
if (!$get) {
    $_SESSION ['error_msg'] = mysqli_error($conn);
    header('location: change-password.php');
    exit();
} 
    $_SESSION ['success_msg'] = "Account created";
    header('location: change-password.php');
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
                        <a href="change-password.php">Change Password</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">

                        <hr>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-register mx-auto mb-5">
                            <div class="card-header">Change Password</div>
                            <div class="card-body">
                                <form action="change-password.php" method="POST">
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
                                    <div class="form-group">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputPassword1">New Password</label>
                                                    <input class="form-control" required=""  id="exampleInputPassword1" type="password" name="password" placeholder="Password">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleConfirmPassword">Confirm password</label>
                                                    <input class="form-control" required=""  id="exampleConfirmPassword" type="password" name="confirm_password" placeholder="Confirm password">
                                                </div>
                                            </div>
                                        </div>                                    
                                        <button type="submit" name="btn" class="btn btn-primary btn-block" >Change Password</button>
                                </form>
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
