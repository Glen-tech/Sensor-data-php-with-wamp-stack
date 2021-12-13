<?php
include 'mylogin.php'; 

$servername = $servernaam;
$username = $naam;
$password = $paswoord;
$dbname = $dbnaam;

$api_key_value = "tPmAT5Ab3j7F9";
$api_key= $id = $value =" ";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	    if(isset($id) && isset($value))
		{
        // Create connection
		$api_key = test_input($_POST["api_key"]);	
		$id = test_input($_POST["id"]);
        $value = test_input($_POST["value"]);
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
				$sql = "INSERT INTO data (Sensor_id,waarde)
				VALUES ('" . $id ."', '" . $value ."')";
				$conn->query($sql);
		
				$json1 = "INSERT into samenvoegen(naam,waarde) VALUES ('".$id."', '".$value."')";
				$conn->query($json1);
				
					if (!empty($_SERVER['HTTP_CLIENT_IP']))   
					{
						$ip_address = $_SERVER['HTTP_CLIENT_IP'];
					}
							//whether ip is from proxy
							elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
							  {
								$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
							  }
									//whether ip is from remote address
									else
									  {
										$ip_address = $_SERVER['REMOTE_ADDR'];
									  }


		if($id == '1')
		{
		$sq2 = "UPDATE sensor SET Ip = '$ip_address' , reading_time = now() WHERE id = 1 ";	
		$conn->query($sq2);
		
		$json2 ="UPDATE samenvoegen SET gegevens = JSON_ARRAY(JSON_OBJECT('ID:', 'Temperatuur' , 'Waarde:',samenvoegen.waarde,' Tijd:',samenvoegen.reading_time)) where naam = 1 ";
		$conn->query($json2);
		
		}
		
		elseif($id == '2')
			{
			$sq3 = "UPDATE sensor SET Ip = '$ip_address' , reading_time = now() WHERE id = 2 ";
			$conn->query($sq3);
			
			$json3 ="UPDATE samenvoegen SET gegevens = JSON_ARRAY(JSON_OBJECT('ID:', 'Licht' , 'Waarde:',samenvoegen.waarde,' Tijd:',samenvoegen.reading_time)) where naam = 2 ";
			$conn->query($json3);
			}		
       /*if ($conn->query($sql) === TRUE && $conn->query($sq2) === TRUE && $conn->query($sq3) === TRUE)
	    {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
			}
    
        $conn->close();
		}*/	
		$conn->close();
 }
}

elseif ($_SERVER["REQUEST_METHOD"] == "GET") 
{
if(isset($_GET['id']) && isset($_GET['value']))
{
	    $link = new mysqli($servername, $username, $password, $dbname);
		$sql = "INSERT INTO data (Sensor_id , waarde)
		VALUES ('".$_GET['id']."', '".$_GET['value']."')
		";
		$json1 = "INSERT into samenvoegen(naam,waarde) VALUES ('".$_GET['id']."', '".$_GET['value']."')";
		$link->query($json1);
	
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   
					{
						$ip_address = $_SERVER['HTTP_CLIENT_IP'];
					}
							//whether ip is from proxy
					elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
					{
					$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
					}
							
					else
					{
					$ip_address = $_SERVER['REMOTE_ADDR'];
					}
		$id = $_GET['id'];
		$link->query($sql);
		
		if($id == '1')
		{
		$sq2 = "UPDATE sensor SET Ip = '$ip_address' , reading_time = now() WHERE id = 1 ";	
		$link->query($sq2);
		
		$json2 ="UPDATE samenvoegen SET gegevens = JSON_ARRAY(JSON_OBJECT('ID:', 'Temperatuur' , 'Waarde:',samenvoegen.waarde,' Tijd:',samenvoegen.reading_time)) where naam = 1 ";
		$link->query($json2);
	
		}
		
		elseif($id == '2')
			{
			$sq3 = "UPDATE sensor SET Ip = '$ip_address' , reading_time = now() WHERE id = 2 ";
			$link->query($sq3);
			
			$json3 ="UPDATE samenvoegen SET gegevens = JSON_ARRAY(JSON_OBJECT('ID:', 'Licht' , 'Waarde:',samenvoegen.waarde,' Tijd:',samenvoegen.reading_time)) where naam = 2 ";
		    $link->query($json3);
			}
$link->close();
}
}

else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}