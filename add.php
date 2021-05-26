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
  <a class="navbar-brand font-weight-bold w-75" href="#">Tele Book</a>
  <form method="POST">
  <button class="btn btn-danger " type="submit" name="signout">Sign Out</button>
  <button class="btn btn-secondary " type="submit" name="back">Back</button>


</form>

</nav>
<div class="container bg-warning text-white mt-5 text-center p-3">
  <h2>Welcome to your account</h2>

</div>
<div class="container mt-3">
  <form method="GET" class="w-50" name="sign">
    <label >The Name</label>
    <input class="form-control " type="text" placeholder="enter the name" name="nname" required/>
    <label class="mt-3">Tele-Number</label>
    <input class="form-control " type="text" placeholder="enter the tele number" name="tnum" required/>
    <button class="btn btn-success mt-3 ml-1" type="submit" name="add" onclick="checknum(event)">Add the Number</button>

  </form>

  <?php
  if(isset($_GET['add'])){
      require_once "dbcontact.php";
      session_start();
    $userid=$_SESSION['userid'];
    $nname=$_GET['nname'];
    $tnum=$_GET['tnum'];

    $adduser=$database->prepare("INSERT INTO nums(name, telnum, userid) VALUES('$nname', '$tnum', $userid)");
    $adduser->execute();
    header("Location:add.php");
  }


?>



</div>
    

<?php
if(isset($_POST['signout'])){
    session_unset();
    header("Location:index.php");

}
elseif(isset($_POST['back'])){
    header("Location:user.php");

}
?>
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