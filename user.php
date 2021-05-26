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
  <a class="navbar-brand font-weight-bold w-50" href="#">Tele Book</a>
  <form method="POST" class="form-inline">
  <button class="btn btn-danger mr-3" type="submit" name="signout">Sign Out</button>
  <button class="btn btn-success mr-3" type="submit" name="add">Add Name</button>
  <button class="btn btn-primary" type="submit" name="search">Search</button>

  <input class="form-control col" type="text" name="searchitem" placeholder="Search for Name..."/>


</form>

</nav>
<div class="container bg-warning text-white mt-5 text-center p-3">
  <h2>Welcome to your account</h2>

</div>
<div class="container bg-light mt-5 text-center p-3 w-50">
  <h5>the names that you have added</h5>

</div>

<div class="container">
    <?php

    require_once "dbcontact.php";
    session_start();
    $userid=$_SESSION['userid'];
    $show=$database->prepare("SELECT nums.name, nums.telnum, nums.numid FROM nums INNER JOIN users ON nums.userid=users.userid WHERE nums.userid='$userid' ORDER BY nums.name");
    $show->execute();
    echo '<table class="table table-dark table-striped mt-4 text-center">
    <thead>
      <tr>
        <th>name</th>
        <th>tel</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>';
    if($show->rowCount() ==0){
        echo '<tr class="text-center">
        <td colspan=3 > no result</td>
        
      </tr>';
    }
     else{ 
    foreach($show AS $data){
        echo '<tr>
        <td>'.$data['name'].'</td>
        <td>'.$data['telnum'].'</td>
        <td><form method="GET">
        <button class="btn btn-danger " type="submit" name="delete" value="'.$data['numid'].'">delete</button>
        <button class="btn btn-warning " type="submit" name="edit" value="'.$data['numid'].'">edit</button>
        
        </form></td>
      </tr>';
    }
      
    if(isset($_GET['delete'])){

        $numid= $_GET['delete'];
        $del=$database->prepare("DELETE FROM nums WHERE numid=$numid ");
        $del->execute(); 
        header("Location:user.php");

      }
      elseif(isset($_GET['edit'])){
       
       
        $_SESSION['numid']=$_GET['edit'];
        header("Location:edit.php");
      }

      
}
      

      echo '</tbody>
  </table>';

    ?>

</div>
    

<?php
if(isset($_POST['signout'])){
    session_unset();
    header("Location:index.php");

}
elseif(isset($_POST['add'])){
    
    header("Location:add.php");

}
elseif(isset($_POST['search'])){
    echo '<h2 class="text-center">your search result</h2>';
    $item=$_POST['searchitem'];
    $searching=$database->prepare("SELECT * FROM nums WHERE name LIKE '%$item%' OR telnum LIKE '%$item%'");
    $searching->execute();
    echo '<table class="table table-striped mt-4 text-center">
    <thead>
      <tr>
        <th>name</th>
        <th>tel</th>
      </tr>
    </thead>
    <tbody>';
    if($searching->rowCount() ==0){
        echo '<tr class="text-center">
        <td colspan=2 > no result</td>
        
      </tr>';
    }
     else{ 
    foreach($searching AS $datas){
        echo '<tr>
        <td>'.$datas['name'].'</td>
        <td>'.$datas['telnum'].'</td>
        
      </tr>';
    } 
    echo '</tbody>
  </table>';
 
     }
}
?>
</body>
</html>