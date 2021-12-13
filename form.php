
<head>
<title>Iotform</title>
</head>
<style>

#Formulier{
	font-size:18px;
	font-style: italic;
	}
	
input[type=submit] {
  background-color: #228B22; /*blacky*/
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
}
</style>
<body>

<?php include 'mylogin.php' ?>
<?php include 'tabledata.php'?>


<form action = 'insertdb.php' method = 'get'>
<img src="IOThumor.jpg" id= "picture" width="200" height="200" align = "right" >
				<p id = "Formulier">ID van de sensor <select name = "id"> </p>
				     	<option value="1">1</option>     
						<option value="2">2</option>	 
						</select><br><br>
				<p id = "Formulier">De waarde <input type="number" name="value" value = ""/></p>
				<p id = "Formulier">&nbsp;<input type="submit" name = "update" value = "Druk hier voor submit "/></p><br>
</form>	

</body>

