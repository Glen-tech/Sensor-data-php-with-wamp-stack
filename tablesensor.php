<!DOCTYPE html>
<html>
<style>
#dataSensor {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top:100px; 
}

#dataSensor td, #dataSensor th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
  font-size: 20px;
}

#Titel{
  font-size: 25px;
  padding-top: 20px;
  padding-bottom: 20px;
}

#dataSensor th {
  padding-top: 12px;
  padding-bottom: 12px;
  color: white;
}

#picture
{
	margin-top : 50px;
	margin-left : 620px;
	
}

#Titelpage{
	text-align : center;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
</style>

<body bgcolor = "#ECF0F1">
<h2 id = "Titelpage"><i>Tabel met de laast bekende timestamp en IP addres.<i></h2>
<?php
include 'mylogin.php';

$servername = $servernaam;
$username = $naam;
$password = $paswoord;
$dbname = $dbnaam;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM sensor ";
$result = mysqli_query($conn, $sql);
	
echo '<table id = "dataSensor">
      <tr> 
        <td id = "Titel"><i>ID</i></td> 
        <td id = "Titel"><i>Sensor</i></td> 
		<td id = "Titel"><i>Timestamp</i></td> 
        <td id = "Titel"><i>Ip</i></td> 
      </tr>';
 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
        echo '<tr>
		<td>'.$row["id"]. '</td>
		<td>'.$row["naam"].'</td>
		<td>'.$row["reading_time"].'</td>
		<td>'.$row["Ip"].'</td>
		</tr>';
    }
} else {
    echo "0 results";
}


$conn->close();
?> 
</table>
<img src="IOTexample.jpg" id= "picture" alt="Trulli" width="500" height="500">
</body>
</html>