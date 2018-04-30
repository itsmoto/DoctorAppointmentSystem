<?php
include './Connectivity.php';
if (empty($_SESSION ['email'])) {
    header('Location: login.php');
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
                        <a href="patient-registration.php">Add a Patient</a>
                    </li>
                </ol>
                <div class="row">
                    <div class="col-12">
                       
                        <hr>
                    </div>

    <div class="card card mx-auto mt-5 mb-5">
      <div class="card-header">Register a Patient</div>
      <div class="card-body">
          <form action="patient-createProfile.php" method="POST">
            <?php if(isset($_SESSION['error_msg'])){
                    echo '<div class="alert alert-danger">';
                    echo $_SESSION['error_msg']; 
                    unset($_SESSION['error_msg']);
                    echo '</div>';
                 }?>
              <?php if(isset($_SESSION['success_msg'])){
                    echo '<div class="alert alert-success">';
                    echo $_SESSION['success_msg']; 
                    unset($_SESSION['success_msg']);
                    echo '</div>';
                 }?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input class="form-control" required="" id="exampleInputName" data-validation="required" data-validation="alphanumeric" type="text"name="fname" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" required="" data-validation="required" data-validation="alphanumeric" id="exampleInputLastName" type="text" name="lname"aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" required=""  id="exampleInputEmail1" name="email" data-validation="required" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" required=""  id="exampleInputPassword1" data-validation="required" type="password" name="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" required=""  id="exampleConfirmPassword" data-validation="required" type="password" name="confirm_password" placeholder="Confirm password">
              </div>
            </div>
          </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Gender</label>
                <div>
                    Male <label class="radio-inline"><input id="exampleInputPassword1" name="gender" type="radio" value="Male" ></label>
                    Female <label class="radio-inline"><input  required=""  id="exampleInputPassword1" name="gender" type="radio" value="Female"></label>
                </div>
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Birthday</label>
                <input class="form-control datepicker"  required=""  id="exampleConfirmPassword" name="date" type="date" data-validation="required">
              </div>
            </div>
                
          </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Phone Number</label>
                <input class="form-control" required=""  id="exampleInputPassword1"name="phone" data-validation="length number" data-validation-length="max13" data-validation="required" type="number" placeholder="Phone Number">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Address : Street</label>
                <input class="form-control" required=""  id="exampleConfirmPassword" data-validation="alphanumeric"  data-validation="required" type="text"name="address" placeholder="Address : Street">
              </div>
            </div>
          </div>
            <div class="form-group">
            <label for="example1InputEmail1">City</label>
            <input class="form-control" required="" data-validation="alphanumeric"  data-validation="required" id="example1InputEmail1" name="city" type="text" aria-describedby="City" placeholder="City">
          </div>
              <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
       
      </div>
    </div>
                    
                                 </div>
                <!-- /.container-fluid-->
                <!-- /.content-wrapper-->
<?php
include './includes/footer.php';
?>
            </div>
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

 