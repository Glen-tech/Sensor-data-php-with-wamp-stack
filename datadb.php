<?php include 'mylogin.php' ?>

<?php 
$servername = $servernaam;
$username = $naam;
$password = $passwoord;
$dbname = $dbnaam;
// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "CREATE TABLE data(
    Sensor_id VARCHAR(15),
	waarde VARCHAR(35),
    reading_time TIMESTAMP)";
	
	if ($conn->query($sql) === TRUE) {
    echo "Table test created successfully";
    } 
	
	else {
    echo "Error creating table: " . $conn->error;
	}
	
$conn->close();
?>