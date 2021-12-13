<?php
include 'mylogin.php';
$servername = $servernaam;
$username = $naam;
$password = $passwoord;
$dbname = $dbnaam;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

## Custom Field value
$id = $_POST['id'];
$value = $_POST['value'];
$time = $_POST['time'];

## Search 
$searchQuery = " ";

if($id != '')
{
   $searchQuery .= " and (Sensor_id like '%".$id."%' ) ";
}
if($value != '')
{
   $searchQuery .= " and (waarde ='".$value."') ";
}

if($time != '')
{
   $searchQuery .= " and (readin_time ='".$value."') ";
}

## Fetch records
$empQuery = "select * FROM data";
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array(
     "id"=>$row['Sensor_id'],
     "waarde"=>$row['waarde'],
     "tijd"=>$row['reading_time']
   );
}

$response = array(
  "draw" => intval($draw),
  "aaData" => $data
);

echo json_encode($response);