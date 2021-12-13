<?php
	include 'mylogin.php';
   // echo "Content-Type: application/rss+xml; charset=ISO-8859-1" ;
 
	$servername = $servernaam;
	$username = $naam;
	$password = $paswoord;
	$dbname = $dbnaam;
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	
    echo '<?xml version="1.0" encoding="ISO-8859-1';
    echo '<rss version="2.0">';

    echo '<channel>';
	echo '<title = now()>Data Sensoren</title>';
			
	echo '<item>';
			$time = "SELECT reading_time as 'time1' FROM sensor WHERE id = 1";
			$res = mysqli_query($conn,$time);
			$time1 = mysqli_fetch_array($res);
			
	echo '<description> Laatst bekende tijd van sensor 1 is ';		
	echo $time1['time1']; 
	echo  '</description>'; 
	echo '</item>'; 
			
	echo '<item>';
	echo '<description>Laatst bekende waarde van sensor 1 is '; 
			
			$last1 = "SELECT data.waarde as 'value' from data,sensor where sensor.reading_time = data.reading_time and sensor.ID = 1";
			$res = mysqli_query($conn,$last1);
			$value1 = mysqli_fetch_array($res);
			
	echo $value1['value']; 
	echo  '</description>'; 
	echo '</item>'; 
		
			
	echo '<item>';
	echo '<description>24 uur gemiddelde waarde van sensor 1 is '; 
	
			$count = "SELECT COUNT(waarde) as 'count' FROM data WHERE reading_time > now() - INTERVAL 24 HOUR AND Sensor_id = 1";
			$res = mysqli_query($conn,$count);
			$uitkomst = mysqli_fetch_array($res);
			
			$sum = "SELECT SUM(waarde) as 'som' FROM data WHERE reading_time > now() - INTERVAL 24 HOUR AND Sensor_id = 1";
			$res = mysqli_query($conn,$sum);
			$som = mysqli_fetch_array($res);
			
	echo  $som['som']/$uitkomst['count'];
			
	echo  '</description>'; 
	echo  '</item>';
	
	echo  '<item>';
			
	echo '<description>Minimum waarde sensor 1 is ';
	
			$value1 = "SELECT MIN(waarde) as 'small' FROM data WHERE Sensor_id = 1";
			$res = mysqli_query($conn,$value1);
			$data1 = mysqli_fetch_array($res);
			
	echo $data1['small'];
			
	echo '</description>';
			
	echo '</item>';
			
	echo '<item>';
    echo '<description>Maximum waarde sensor 1 is ';
	
			$value2 = "SELECT MAX(waarde) as 'big' FROM data WHERE Sensor_id = 1";
			$res = mysqli_query($conn,$value2);
		    $data2 = mysqli_fetch_array($res);echo $data2['big']; 
					  
	echo  '</description>'; 
	echo  '</item>';
			
	echo '<item>';
	echo '<description>Laatst bekende tijd van sensor 2 is ';
	
			$time2 = "SELECT reading_time as 'time2' FROM sensor WHERE id = 2";
			$res = mysqli_query($conn,$time2);
			$time2 = mysqli_fetch_array($res);
			
	echo $time2['time2'];
	echo '</description>';
	echo '</item>';
	
	echo '<item>';
	echo '<description>Laatst bekende waarde van sensor 2 is ';
	
			$last2 = "SELECT data.waarde as 'value2' from data,sensor where sensor.reading_time = data.reading_time and sensor.ID = 2;";
			$res = mysqli_query($conn,$last2);
			$value2 = mysqli_fetch_array($res);
			
	echo $value2['value2'];
	echo '</description>';
	echo '</item>';
			
	echo '<item>';
	echo '<description>24 uur gemiddelde waarde van sensor 2 is '; 
	
			$count = "SELECT COUNT(waarde) as 'count' FROM data WHERE reading_time > now() - INTERVAL 24 HOUR AND Sensor_id = 2";
			$res = mysqli_query($conn,$count);
			$uitkomst = mysqli_fetch_array($res);
			
			$sum = "SELECT SUM(waarde) as 'som' FROM data WHERE reading_time > now() - INTERVAL 24 HOUR AND Sensor_id = 2";
			$res = mysqli_query($conn,$sum);
			$som = mysqli_fetch_array($res);
			
	echo $som['som']/$uitkomst['count'];	
	echo '</description>';
	echo '</item>';		
			
	echo '<item>';
	echo '<description>Minimum waarde sensor 2 is ';
			$value3 = "SELECT MIN(waarde) as 'small2' FROM data WHERE Sensor_id = 2";
			$res = mysqli_query($conn,$value3);
			$data3 = mysqli_fetch_array($res);
			
	echo $data3['small2'];
	echo '</description>';
	echo '</item>';
		
	echo '<item>';
    echo '<description>Maximum waarde sensor 2 is ';
					  $value4 = "SELECT MAX(waarde) as 'big2' FROM data WHERE Sensor_id = 2";
					  $res = mysqli_query($conn,$value4);
					  $data4 = mysqli_fetch_array($res);
					  echo $data4['big2'];
	echo '</description>';
	echo '</item>';			  				  
    echo '</channel>';
    echo '</rss>';?>
  