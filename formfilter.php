<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
  
 </head>
 <body bgcolor = "#ECF0F1">

  <div class="container">
   <br />
   <h2 align="center">Data van de sensors</h2><br />
   <div class="form-group" align = "center">
    <div class="input-group">
	 <form id = "filterdata">
     <input type="number"  id="nummer" placeholder="Geef uw sensor in " class="form-control" />
	 <input type="number" id="waarde" placeholder="Geef uw waarde in " class="form-control" />
	 </form>
    </div>
   </div>
   <br />
   <div id="result"></div>
  </div>
 </body>


<script>
$(document).ready(function(){

 load_data();
 
 function load_data(number,value,time)
 {
  $.ajax({
   url:"tabledata.php",
   method:"POST",
   data:{number:number,value:value,time:time},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#filterdata').keyup(function(){
  var nummer = $('#nummer').val();
  var waarde = $('#waarde').val();
 
  if(nummer !=''||waarde !='')
  {
   load_data(nummer,waarde);
  }
  else
  {
   load_data();
  }
 });
});
</script>

</html>