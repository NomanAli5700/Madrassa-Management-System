<?php
$servername= "localhost";
$username= "root";
$password= "";
$dbname= "MMS";

 $conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
  echo"failed to connect";
  exit;
}
//if(empty($_SESSION)){
 session_start();
//

?>