<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$ip = mysqli_real_escape_string($mysqli, $_POST['ip']);
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	
	// checking empty fields
	if(empty($ip) ) {	
			
		echo "<font color='red'>IP field is empty.</font><br/>";
		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE client_IP SET ip='$ip' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM client_IP WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$ip = $res['ip'];

}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>IP</td>
				<td><input type="text" name="ip" value="<?php echo $ip;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
