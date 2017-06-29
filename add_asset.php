<?php
include_once 'config.php';
//variables for fetching input data and storing.
if( isset($_POST) && isset($_POST['asset_sno']) ){
	$asset_sno = $_POST['asset_sno'];
	$asset_type = $_POST['selection']; //because its a selection we need to use select name
	$desc = $_POST['desc'];
	$gps = $_POST['choose']; //because its a selection we need to use select name
	
	
	get_information( $asset_sno, $asset_type, $desc, $gps ); 
}//if data has been sent via POST

function get_information( $asset_sno, $asset_type, $desc, $gps ){
	global $db; //use the globally declared DB connection
	$chk = $db->prepare(  'INSERT INTO assets values(?,?,?,?)'  ); //since I've used PDO-MySQL, you use placeholders (?) in your query. When executing it, you pass the information needed as an array
	$chk->execute(array($asset_sno, $asset_type, $desc, $gps));
}

?>

        
<!DOCTYPE html>
<html>
<head>
<title>add_asset</title>
    <link rel="stylesheet" type="text/css" href="addasset.css">
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
        <div id="cantfind">Adding Assets Made Easy</div> 
        <div id="add"><h2><a onclick="myFunction()" href="#" style="text-decoration:none;">Add asset</a></h2></div>
            
        <div id = "container">
        
<!--			<h1 id="logo">ADD ASSET</h1>-->
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


			<div id="addasset">
				<form method="POST" name="add_asset" id="add_asset">
					<fieldset>
						<label for="asset_sno">Serial Number*</label>
						<input type="number" id="asset_sno" name="asset_sno">
						<label for="asset_type">Asset Type*</label>
                        <select name="selection" spellcheck="false" style="width:77%">
                            <option>Trailer Tracking</option>
                            <option>Intermodal Containers</option>
                            <option>Heavy Equipment</option>
                            <option>Cold Chain Equipment</option>
                            <option>Oil and Gas</option>
                            <option>Maritime</option>
                        </select>
						<label for="desc">Description</label>
						<input type="textarea" id="desc" name="desc">
						<label for="gps">GPS</label>
                        <select name="choose" spellcheck="false" style="width:77%">
                            <option>IDP-800 (Satellite)</option> <!--vaildation: can select only if asset type is trailer-->
                            <option>GT 2300 (Cellular)</option> <!--validation:can select only if assettype is intermodal-->
                            <option>PT 7000 (Cellular, Dual-Mode)</option> <!--valid only if asset type is heavy equip-->
                            <option>Euroscan MX2 (Cellular)</option><!--valdiation: can select only if the asset type is                                              cold chain-->
                            <option>GT 700 (Satellite) </option><!--can select only if asset type is oil and gas-->
                            <option>IDP-690 (Satellite)</option> <!--Can select only if asset type is maritime-->
                        </select>
                        
                      <input type="submit" value="save">
					</fieldset>
				</form>
                			</div> <!--addemp div ends here-->

        <!--footer table-->
        
<!--myFunction() code-->
        <script>
            
            function myFunction(){
                
                var x=document.getElementById('addasset');
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