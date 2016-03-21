<?php
   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "mytestdb";
   $con = mysql_connect("localhost","root","");
mysql_select_db("mytestdb", $con);
if($con)
echo "Connected";
else 
echo "Could not be Connected";


   $sql = 'SELECT name, email, age, address, gender FROM empdetails';
   $retval = mysql_query( $sql);
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
   
   while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
      echo "name :{$row['name']}  <br> ".
         "email : {$row['email']} <br> ".
         "age : {$row['age']} <br> ".
         "address : {$row['address']} <br> ".
         "gender : {$row['gender']} <br> ".
         
         "<br>";
   }
   
   echo "Fetched data successfully\n";
   
?>