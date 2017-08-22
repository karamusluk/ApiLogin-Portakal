<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM client_IP WHERE type='default' ORDER BY id DESC"); // using mysqli_query instead
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="add.html">Add New Data</a><br/><br/>
	<p> View all allowed IP adresses</p><br>
	<table width='50%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td width='10%'>ID</td>
		<td width='55%'>IP Adress</td>
		<td width='35%'>Update</td>
	</tr>
	<?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['id']."</td>";
		echo "<td>".$res['ip']."</td>";	
		echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	$result = mysqli_query($mysqli, "SELECT * FROM client_IP WHERE type='range' ORDER BY id DESC"); // using mysqli_query instead

	?>
	</table>
	<br>
	<p> View all allowed IP Adress Range</p>
	<table width='50%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td width='10%'>ID</td>
			<td width='55%'>IP Range</td>
			<td width='35%'>Update</td>
		</tr>
		<?php 
		
		while($res = mysqli_fetch_array($result)) { 		
			echo "<tr>";
			echo "<td>".$res['id']."</td>";
			echo "<td>".$res['ip']."</td>";	
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		}
		?>
	</table>
</body>
</html>
