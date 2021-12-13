<?php 

include 'db.php';


$conn = new mysqli($servername, $username, $password, $dbname);
$result = mysqli_query($conn, "SELECT * FROM data");

?>


<!DOCTYPE html>
<html>
 <body>
 <head>
  <style>
    body 		{height: 90%; margin: 0;text-align:center; background-color: black; font-family:courier; background-attachment: fixed;} 
    button		{margin: 10px; padding: 12px 28px; -webkit-transition-duration: 0.4s; transition-duration: 0.4s;  text-decoration: none; background-color: gold; color: black; border-radius: 6px;}
    button:hover{background-color: black; color: gold; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);}
	h2          {margin: 25px; text-align:center; color:gold;}

  </style>

  
 <h2>Results light and temperature</h2>
 
 <button type="button" id="Temp"  abbr title="Click to view only the temperature">Temperature</button>
 <button type="button" id="Light" abbr title="Click to view only the light" >Light</button>
 
 <div id="linechart_material"></div>
 <div id="chart_div"></div>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.load('visualization', '1.1', { packages: ['corechart'] });
	google.setOnLoadCallback(drawChart);

      function drawChart() {
		var data = new google.visualization.DataTable();
	
		data.addColumn('datetime','Time');
		data.addColumn('number','Light');
		data.addColumn('number','Temperature');
		data.addRows([
		<?php 
			if(mysqli_num_rows($result)> 0)
			{ 
                while($row = mysqli_fetch_array($result))
				{
						
					$timestamp = strtotime($row['datumzz']);
					$year   = date("Y", $timestamp);
					$month  = date("m", $timestamp);
					$day    = date("d", $timestamp);
					$hour   = date("h", $timestamp);
					$minute = date("i", $timestamp);
						
						if($row['sensor_id'] == 1 )
						{
							 echo "[new Date($year,($month-1),$day,$hour,$minute),null,".$row['value']."],";
						}
							if($row['sensor_id'] == 2)
							{
								 echo "[new Date($year,($month-1),$day,$hour,$minute),".$row['value'].",null] ,";
								 
						    }
				}

            }   
		?>
		]);
          
          var options = {
		  interpolateNulls: true,
          titlePosition: 'none',    
          curveType: 'function',
		  width: '800',
          height: '800',
          chartArea: {'width': '80%', 'height': '60%'},
          legend: { position: 'top',textStyle: {color: 'white'}},
          vAxis: {title: 'Value',titleTextStyle: {color: 'white'},minValue: 0, textStyle: {color: 'white'}},      
          hAxis: {title: 'Time', titleTextStyle: {color: 'white'},textStyle: {color: 'white'}},//slantedText:true, slantedTextAngle:80
          curveType: 'function',
          pointSize: 5,      
		  colors: ['green','blue'],
          backgroundColor: 'black',
          explorer: { 
            actions: ['dragToZoom', 'rightClickToReset'],
            axis: 'horizontal',
            keepInBounds: true,
            maxZoomIn: 4.0}};

       var temp = 1;
       var light = 1;     
	   var Temp = document.getElementById("Temp");
       Temp.onclick = function()
       {
           temp += 1;
           if(temp==2){  
            temp -= temp ;
			  view = new google.visualization.DataView(data);
			  view.hideColumns([1]); 
			  chart.draw(view, options); 
           }       
            else{
			  view = new google.visualization.DataView(data);
			  chart.draw(view, options);
            }
       }
       
			
	   var Light = document.getElementById("Light");
	   Light.onclick = function()
	   {
        light += 1;
        if(light==2){  
          light -= light ;
		  view = new google.visualization.DataView(data);
		  view.hideColumns([2]); 
		  chart.draw(view, options);
        }
            else{
			  view = new google.visualization.DataView(data);
			  chart.draw(view, options);
            }
	   }
	    
		
	   var chart = new google.visualization.AreaChart(document.getElementById('linechart_material'));
	   chart.draw(data, options);
      }
    </script>
  </head>
 </body>
</html>