<?php
class Dbh {
  protected $host = "localhost";
  protected $user = "root" ;
  protected $pass = "";
  protected $db   = "register_login";
  protected $conn;
  public function __construct(){
  $this->conn = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
  }
}
class Confirm {
  public function pass($pass,$cpass){
  if($pass == $cpass) {
    return 2;
  }else {
    return 200;
   }
  }
}
class Register extends Dbh {
  public function exists($email){
    $sql = "SELECT * FROM users WHERE email='$email'";
   $res = mysqli_query($this->conn,$sql);
   if(mysqli_num_rows($res)>0){
     return 3;
   }else{
     return 300;
   }
  }
  public function pass($pass,$cpass){
    if($pass == $cpass){
      return 5;
    }else{
      return 500;
    }
  }
  public function user($name,$email,$pass){
  $sql = "INSERT INTO `users`(`name`, `email`, `pass`) VALUES ('$name','$email','$pass')";  
  mysqli_query($this->conn,$sql);
  }
}
class Login extends Dbh {
  private $email;
  private $passi;
  public function start($email,$passi){
  $this->email = $email;
  $this->passi = $passi;
  $log ="SELECT * FROM users WHERE email='$email' AND pass='$passi'";
  $rem = mysqli_query($this->conn,$log);
  $row = mysqli_num_rows($rem);
  if($row == 1){
    $session = mysqli_fetch_array($rem);
    session_start();
    $_SESSION['id'] = $session['id'];
    return 4;
  }else{
    return 400;
  }
  }
}
class Redirect {
  public $login = "dashboard.php";
  public $exit  = "login.php";
  public function loginn(){
    header("Location:$this->login");
  }
  public function out(){
    header("Location:$this->exit");
  }
}
class Destroy {
  public function session (){
session_unset();
session_destroy();
header("Location:login.php");
return 22;
  }
}
class User extends Dbh{
 public $name;
 public function getName($id){
 $sql = "SELECT * FROM users WHERE id='$id'";
 $res = mysqli_query($this->conn,$sql);
 $name = mysqli_fetch_array($res);
 $this->name = $name['name'];
 return $this->name;
 }
}
?>