<?php
include_once 'config.php';
//variables for fetching input data and storing.
if( isset($_POST) && isset($_POST['device_id']) ){
	$device_id = $_POST['device_id'];
	$device_type = $_POST['selection'];//because its a selection we need to use select name
    $model_name = $_POST['model_name'];
    $manufacturer = $_POST['manufacturer'];
	$desc = $_POST['desc'];
	//select icon 
	
	
	get_information( $device_id, $device_type, $model_name, $manufacturer, $desc ); 
}//if data has been sent via POST

function get_information( $device_id, $device_type, $model_name, $manufacturer, $desc ){
	global $db; //use the globally declared DB connection
	$chk = $db->prepare(  'INSERT INTO devices values(?,?,?,?,?)'  ); //since I've used PDO-MySQL, you use placeholders (?) in your query. When executing it, you pass the information needed as an array
	$chk->execute(array($device_id, $device_type, $model_name, $manufacturer, $desc));
}

?>

        
<!DOCTYPE html>
<html>
<head>
<title>add_device</title>
    <link rel="stylesheet" type="text/css" href="adddevice.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

    <!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
    <![endif]-->
			    

    </head>
    <body id="main">
        <header id="head">
                </header>
                        <div id="cantfind">Can't find the device you're looking for?</div>
        				<div id="add"><h2><a onclick="myFunction()" href="#" style="text-decoration:none;">Add GPS Device</a></h2></div>


        <div id = "container">
        
<!--			<h1 id="logo">ADD GPS DEVICE</h1>-->
            <!--toggling footer using JQuery-->
                <script>
                $(function() {
    $('tr.parent')
        .click(function(){
            $(this).siblings('.child-'+this.id).toggle('slow');
        });
    $('tr[class^=child-]').hide().children('td');
});
</script>
<!--footer toggle ends here-->    
            <!--form validation-->
 
                <!--            validation ends-->
            			</div><!--container class ends here-->
			<div id="adddevice">
				<form method="POST" name="add_device" id="add_device">
					<fieldset>
						<label for="device_id">Device ID*</label>
						<input type="number" id="device_id" name="device_id">
						<label for="device_type">Device Type*</label>
                        <select name="selection" spellcheck="false" style="width:77%">
                            <option>Cellular</option>
                            <option>Cellular and Dual-Mode</option>
                            <option>Satellite</option>
                            <option>Satellite AIS</option>
                        </select>
						<label for="manufacturer">Manufacturer</label>
                        <input type="text" id="manufacturer" name="manufacturer">
                        <label for="model_name">Model Name*</label>
                        <input type="text" id="model_name" name="model_name">
                        <label for="desc">Description</label>
						<input type="textarea" id="desc" name="desc">
						
                      <input type="submit" value="save">
					</fieldset>
				</form>
                			</div> <!--addemp div ends here-->
        <!--footer table-->
        
<!--myFunction() code-->
        <script>
            
            function myFunction(){
                
                var x=document.getElementById('adddevice');
                if(x.style.display === 'none'){
                    x.style.display = 'block';
                }else{
                    x.style.display='none';
                }
            }
       </script> <!--myFunction()code ends here-->
        
        <!--toggling footer table data: myFunction2()-->
        

    </body>
</html>