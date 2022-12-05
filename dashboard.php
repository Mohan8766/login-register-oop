<?php
include('class.php');
$Destroy = new Destroy();
$Redirect = new Redirect();
$Name = new User();
session_start();
$check = $_SESSION['id'];
if(!$check){
  $Redirect->out();
}else{
 $nn = $Name->getName($check);
}
if(isset($_POST['logout'])){
  $Destroy->session();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title></title>
   
  </head>
  <body>
    <h1>Hello Dear <?php echo $nn ?> Welcome</h1>
    <form action="" method="post">
    <button name="logout">Logout</button>
    </form>
  </body>
</html>