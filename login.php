<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?> ">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand font-weight-bold" href="#">Tele Book</a>

</nav>
<div class="container bg-warning text-white mt-5 text-center p-3">
  <h2>Welcome to our website kindly Log in first</h2>

</div>
<div class="container mt-3">
  <form method="GET" class="w-50" >
    <label >FirstName</label>
    <input class="form-control " type="text" placeholder="enter your firstname" name="fname" required/>
    <label class="mt-3">LastName</label>
    <input class="form-control " type="text" placeholder="enter your lastname" name="lname" required/>
     <label class="mt-3">Password</label>
    <input class="form-control " type="password" placeholder="enter your password" name="pass" required/>
    <div class="row w-75">
    <button class="btn btn-success mt-3 ml-3 col" type="submit" name="login" >Log In</button>

  </form>
  <form method="POST" class="inline-form ">
  <button class="btn btn-primary mt-3 ml-1 col " type="submit" name="sign">Don't have an account</button>

  </form>
</div>
<?php
if(isset($_GET['login'])){
    require_once "dbcontact.php";
    $fname=$_GET['fname'];
    $lname=$_GET['lname'];
    $pass=$_GET['pass'];
    $log=$database->prepare("SELECT * FROM users WHERE fname='$fname' AND lname='$lname' AND pass='$pass'");
    $log->execute();
    if($log->rowCount()==1){
      $log=$log->fetch(PDO::FETCH_ASSOC);  
      session_start();
      $_SESSION['userid']=$log['userid'];
      header("Location:user.php");

    }
    else{
        echo '<div class="alert alert-danger w-75 mt-3">
unavailable account!
    </div>';
    }

}
elseif(isset($_POST['sign'])){
    header("Location:index.php");
}

?>

</div>


</body>
</html>