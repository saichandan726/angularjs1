<html>
<body>
	<title>Factorial Program in PHP</title>
	<form action="" method="post">
		<label>Enter Number to calculate Factorial</label> <input type="text" name="number"  />
		
	</form>
</body>
</html>
 
<?php 
	
	if($_POST){
		
		$fact = 1;
		
		$number = $_POST['number'];
		
		echo "Factorial of $number:<br><br>";
		
				for ($i = 1; $i <= $number; $i++)
				{	
					$fact = $fact * $i;
					print $fact . "<br>";
				}
	}
 
?>
