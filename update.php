<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mytestdb";


$con=mysql_connect('localhost','root','');
mysql_select_db("mytestdb", $con);
if($con)
echo "Connected";
else echo "Could not be Connected";

 /*$insert = mysql_query("INSERT INTO `employee` (firstName,lastName,age,phone)
VALUES ('ravi','huryy',26,'9492862735')"); 
//mysql_query($insert);
$id= mysql_insert_id();
echo $id;*/


//$delete = mysql_query("delete from `employee` where id=3");
$update = mysql_query("update `employee`
								set firstName='sastry'
								where firstName='sai'");

?>
