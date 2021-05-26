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
  <form method="GET" class="w-50" name="sign">
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
    <button class="btn btn-success mt-3 ml-1" type="submit" name="sign" onclick="checknum(event)">Sign Up</button>

  </form>
  <?php
  if(isset($_GET['sign'])){
    $fname=$_GET['fname'];
    $lname=$_GET['lname'];
    $city=$_GET['city'];
    $telnum=$_GET['telnum'];
    $pass=$_GET['pass'];
    require_once "dbcontact.php";
    $adduser=$database->prepare("INSERT INTO users(fname, lname, city, telnum, pass) VALUES('$fname', '$lname', '$city', '$telnum', '$pass')");
    $adduser->execute();
    $getid=$database->prepare("SELECT userid FROM users WHERE fname='$fname' AND lname='$lname' AND telnum='$telnum' AND pass='$pass'");
    $getid->execute();
    $getid=$getid->fetch(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['userid']=$getid['userid'];
    header("Location:user.php");

  }
  ?>

</div>

    
</body>
<script>
  function checknum(event){
    var num=document.sign.telnum.value;
    if(num.length!=10 && !num.startsWith("09")){
      alert("you have enterd an invalid number!");
      event.preventDefault();
      return (false);
    }
  }
</script>
</html>