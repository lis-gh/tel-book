<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?> ">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand font-weight-bold" href="#">Tele Book</a>

</nav>
<div class="container bg-warning text-white mt-5 text-center p-3">
  <h2>Welcome to our website kindly sign up first</h2>

</div>

<div class="container mt-3">
  <form method="GET" class="w-50 mb-5" name="sign">
    <label >FirstName</label>
    <input class="form-control " type="text" placeholder="enter your firstname" name="fname" required/>
    <label class="mt-3">LastName</label>
    <input class="form-control " type="text" placeholder="enter your lastname" name="lname" required/>
    <label class="mt-3">City</label>
    <input class="form-control " type="text" placeholder="enter your city" name="city" required/>

    <label class="mt-3">Tele-Number</label>
    <input class="form-control " type="number" placeholder="enter your tele number" name="telnum" required/>
    <label class="mt-3">Password</label>
    <input class="form-control " type="password" placeholder="enter your password" name="pass" required/>
    <label class="mt-3">confirm-Password</label>
    <input class="form-control " type="password" placeholder="confirm your password" name="conpass"  required/>

    <div class="row w-75">
    <button class="btn btn-success mt-3 ml-3 col" type="submit" name="sign" onclick="checknum(event)">Sign Up</button>
  </form>

  <form method="POST" class="inline-form ">
  <button class="btn btn-primary mt-3 ml-1 col " type="submit" name="login">have an account</button>

  </form>
  </div>
  <?php
  if(isset($_GET['sign'])){
    require_once "dbcontact.php";
    $fname=$_GET['fname'];
    $lname=$_GET['lname'];
    $city=$_GET['city'];
    $telnum=$_GET['telnum'];
    $pass=$_GET['pass'];
    $check=$database->prepare("SELECT * FROM users WHERE fname='$fname' AND lname='$lname' OR telnum='$telnum'");
    $check->execute();
    if($check->rowCount() ==0){
    
    $adduser=$database->prepare("INSERT INTO users(fname, lname, city, telnum, pass) VALUES('$fname', '$lname', '$city', '$telnum', '$pass')");
    $adduser->execute();
    $getid=$database->prepare("SELECT userid FROM users WHERE fname='$fname' AND lname='$lname' AND telnum='$telnum' AND pass='$pass'");
    $getid->execute();
    $getid=$getid->fetch(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['userid']=$getid['userid'];
    header("Location:user.php");
  }else{
    echo '<div class="alert alert-danger mt-3 w-75">
This account has already created!
    </div>';
  }
  }
  elseif(isset($_POST['login'])){
    header("Location:login.php");

  }
  ?>

</div>

    
</body>
<script>
  function checknum(event){
    var num=document.sign.telnum.value;
    var pass=document.sign.pass.value;
    var conpass=document.sign.conpass.value;
    if(num.length!=10 && !num.startsWith("09")){
      alert("you have enterd an invalid number!");
      event.preventDefault();
      return (false);
    }
    else if(pass != conpass) {
      alert("your password confirmation wrong!");
      event.preventDefault();
      return (false);
    }
  }
</script>
</html>