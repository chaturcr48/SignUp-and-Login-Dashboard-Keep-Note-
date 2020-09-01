<?php

$showAlert=false;
$showError=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
  include "Partials/_dbconnect.php";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $c_password=$_POST['c_password'];

  $existSql="SELECT * FROM `user` WHERE username='$username'";
  $result=mysqli_query($conn, $existSql);
  $numExistRows=mysqli_num_rows($result);
  
  if($numExistRows > 0){
    $showError="Username already exist.";
  }
  else{
    if($password==$c_password){
      $hash=password_hash("$password", PASSWORD_DEFAULT);
      $sql="INSERT INTO `user` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
      $result=mysqli_query($conn, $sql);
      if($result){
        $showAlert=true;
      }
    }
    else{
      $showError="Password do not match.";
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>SignUp</title>

</head>
<body>

  <?php require "Partials/_nav.php" ?>
  <?php
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account is created, now you can login to continue.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '.$showError.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    }
  ?>
  <div class="container my-4">
    <h1 class="text-center">SignUp to our website</h1>
    <form action="/CHATUR_PHP/Proj-1/SignUp.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="c_password">Confirm Password</label>
        <input type="password" class="form-control" id="c_password" name="c_password">
        <small class="form-text text-muted">Make sure that the password is same.</small>
      </div>
      <button type="submit" class="btn btn-primary">SignUp</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>

</body>
</html>
