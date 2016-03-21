<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

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

 if(isset($_POST['submit'])){

$insert="INSERT INTO  empdetails (name,email,age,address,gender)
VALUES('".$_POST['name']."','".$_POST['email']."','".$_POST['age']."','".$_POST['address']."','".$_POST['gender']."')";
 $sql=mysql_query($insert);
if ($sql)
echo "1 record added";
else
echo "failed";

}
$nameErr = $emailErr = $genderErr = $ageErr = "";
$name = $email = $gender = $address = $age = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
    
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
    
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
     
   if (empty($_POST["age"])) {
     $age = "";
   } else {
     $age = test_input($_POST["age"]);
     
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$age)) {
       //$ageErr = "Invalid URL"; 
     }
   }

   if (empty($_POST["address"])) {
     $address = "";
   } else {
     $address = test_input($_POST["address"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   age: <input type="text" name="age" value="<?php echo $age;?>">
   <span class="error"><?php echo $ageErr;?></span>
   <br><br>
   address: <textarea name="address" rows="5" cols="40"><?php echo $address;?></textarea>
   <br><br>
   Gender:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male
   <span class="error">* <?php echo $genderErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
	<input type="reset" name="reset" value="reset"> 
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $age;
echo "<br>";
echo $address;
echo "<br>";
echo $gender;
echo "<br>";
?>
</body>
</html>