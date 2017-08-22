<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$ip = mysqli_real_escape_string($mysqli, $_POST['ip']);
	$iprange = mysqli_real_escape_string($mysqli, $_POST['iprange']);
		
	// checking empty fields
	if(!empty($ip) || !empty($iprange)) {
				
		if(!empty($ip)) {
			$result = mysqli_query($mysqli, "INSERT INTO client_IP(ip,type) VALUES('$ip','default')");
			echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='index.php'>View Result</a>";
			
		}
		if(!empty($iprange)) {
			$result = mysqli_query($mysqli, "INSERT INTO client_IP(ip,type) VALUES('$iprange','range')");
			echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='index.php'>View Result</a>";
		}
		
		
		//link to the previous page
		
	} else { 
		// if all the fields are filled (not empty) 
		echo "<font color='red'>ip or range field is empty.</font><br/>";	
		//insert data to database	
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	}
}
?>
</body>
</html>
