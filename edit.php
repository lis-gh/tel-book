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
  <form method="GET" class="w-50" >
    <label >First Name</label>
    <?php
    session_start();
    $numid=$_SESSION['numid'];
    require_once "dbcontact.php";
    $getitem=$database->prepare("SELECT * FROM nums WHERE numid=$numid");
    $getitem->execute();
    $getitem=$getitem->fetch(PDO::FETCH_ASSOC);

   echo '
    <input class="form-control " type="text"  name="fname" value="'.$getitem['fnname'].'"/>
    <label class="mt-3">Last Name</label>
    <input class="form-control " type="text"  name="lname" value="'.$getitem['lnname'].'"/>

    <label class="mt-3">Tele-Number</label>
    <input class="form-control " type="text"  name="tnum" value="'.$getitem['telnum'].'"/>
    <button class="btn btn-success mt-3 ml-1" type="submit" name="edit">Edit the Number</button>

  </form>';
  if(isset($_GET['edit'])){
      $newfname=$_GET['fname'];
      $newlname=$_GET['lname'];
      $newnum=$_GET['tnum'];
      
      require_once "dbcontact.php";
      $update=$database->prepare("UPDATE nums SET fnname='$newfname', lnname='$newlname', telnum='$newnum' WHERE numid=$numid");
      
      if($update->execute() ){
        if($update->rowCount()==1){
       // echo '<script>alert("the name has been updated successfully");</script>';
 
       header("Location:edit.php?success=1");
      }
      /*  echo '<script>
                 setTimeout(function(){
                    window.location.href = "edit.php";
                 }, 1000);
              </script>';
      */
      elseif($update->rowCount()==0){
        echo '<div class="alert alert-warning mt-3">the number has no updated </div>';

      }

      }else{
        echo '<div class="alert alert-danger mt-3">the number data failed to update </div>';

      }

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
elseif(isset( $_GET['success']) ){
  if($_GET['success']==1){
  echo '<div class="alert m-4 alert-success mt-3">the number data updated successfully</div>';
}
}

?>
</body>
</html>