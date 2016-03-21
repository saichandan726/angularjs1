
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

$con = mysql_connect("localhost","root","");
mysql_select_db("mytestdb", $con);
if($con)
echo "Connected";
else 
echo "Could not be Connected";
 
$insert="INSERT INTO  adding (firstName,lastName)
VALUES('".$_POST['firstName']."','".$_POST['lastName']."')";
 $sql=mysql_query($insert);
if ($sql)
echo "1 record added";
else
echo "failed"
 
?>
