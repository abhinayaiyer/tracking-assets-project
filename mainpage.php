<?php
include_once 'config.php';
//variables for fetching input data and storing.
if( isset($_POST) && isset($_POST['emp_id']) ){
	$emp_id = $_POST['emp_id'];
	$name = $_POST['name'];
	$dept = $_POST['dept'];
	$doj = $_POST['doj'];
	$sal = $_POST['sal'];
	
	
	get_information( $emp_id, $name, $dept, $doj, $sal ); 
}//if data has been sent via POST

function get_information( $emp_id, $name, $dept, $doj, $sal ){
	global $db; //use the globally declared DB connection
	$chk = $db->prepare(  'INSERT INTO employee values(?,?,?,?,?)'  ); //since I've used PDO-MySQL, you use placeholders (?) in your query. When executing it, you pass the information needed as an array
	$chk->execute(array($emp_id, $name, $dept, $doj, $sal));
}

?>
        
<!DOCTYPE html>
<html>
<head>
<title>main_page</title>
    <link rel="stylesheet" type="text/css" href="mainpage.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

    <!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
    <![endif]-->

    </head>
    <body id="main">
        <div>
        <nav id="header">
            <ul>
<!--             <li><img src="images/trackassets2.png"></li>-->
                <li><a href="#">Locate Assets</a></li>
                <li><a href="#">Add Asset</a></li>
                <li><a href="#">Add Device</a></li>
            </ul>
        </nav>
        </div>
        <div>
        	<h1 id="logo">Locate Asset</h1>
        </div>
        <div id="container">
        <!--The below code is for search bar-->    
            <form id="find" method="post">
				<div style="width:80%; float:left;">
				<input type="text" id="searchAssetType" placeholder="search asset types">
					</div>
				<div style="width:20%; float:right;">
					<button type="button" onclick="loadDoc()">Search</button> 
				</div>
				<div  style="clear:both"></div>
                </form>
			
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript">
			function loadDoc(){
				//assign the value of the textbox to a variable.
				var searchAssetType = $('#searchAssetType').val();
				//alert(findemp);
				//make an ajax call to fetch the data from the attached XML file.
				$.ajax({
					type: "GET",
					url: "asset_types.xml",
					dataType: "xml",
					success: function(xml){
						$(xml).find('ASSETTYPE').each(function(){
							//find every Employee node
							var atname = $(this).find('ATNAME').text();//fetch name and save to a variable. //ATNAME is asset type name
							if( atname.indexOf(searchAssetType)>=0 ){ //string function. It checks the presence of 'findemp' inside 'fname'
                                var aticon=$(this).find('ATICON').text();
                                var newrow = '<tr><td>'+ atname +'</td><td>'+ aticon + '</td></tr>'
								$("#response").append(newrow);
							}
							
						});
					},
					error: function() {
						alert("An error occurred while processing XML file.");
					}
				});

			}
            
                        
		</script>
        
             
<!--to split screen into three, create a table. I'm using 2 rows (because there are six icons and 3 in each) and three columns-->
            <table id = "split">
                <tr>
                    <th colspan="3">Asset Type</th>
                    <th>Assets of this type</th>
                    <th>Location Details</th>
                </tr>
                <tr>
                    <td>
                        <!--split this cell three ways to accomodate 3 icons-->
                        <a href="#" onclick="myFunction1()"><img src="images/assettypes/trailer.png" alt="trailer" id="trailer"></a>
                    <div class="overlay">Trailers, Dry vans, Chasis</div>
                    </td>
                    <td>
                        <a href="#" onclick="loadDoc()">
                        <img src="images/assettypes/intermodal.png" alt="intermodal" id="intermodal">
                        </a>
                        <div class="overlay">Intermodal Containers</div>
                    </td>
                    <td>
                        <a href="#" onclick="loadDoc()">
                        <img src="images/assettypes/coldchain.png" alt="coldchain" id="coldchain">
                    </a>
                        <div class="overlay">Cold Chain Equipment</div>
                    </td>
                    <td>
                        <!--retrieving data from db-->
                

                        <?php
        include_once 'config.php';
global $db;
global $get_users;
        $get_users=$db->prepare('SELECT assetID FROM main WHERE asset_type="Trailer" ');
        $get_users->execute();
        $users = $get_users->fetchAll();
foreach ($users as $user) {
    echo $user['assetID'] . '<br />';
}
?>                        


<!--
                    <script>
                        $.post('trailer.php', function(result) { 
                        alert(result); 
                        });
                                
                        </script>    
  
-->
                    </td>
                    <td>
                        there won't be any split here. Cuz only one asset's location details should be shown.
                    </td>
                </tr>
                <tr>
                    <td>
                        <!--split this cell three ways to accomodate 3 icons-->
                        <a href="#" onclick="loadDoc()">
                        <img src="images/assettypes/heavy.png" alt="heavyequip" id="heavy">
                            </a>
                        <div class="overlay">Heavy Equipment</div>
                    </td>
                    <td>
                        <a href="#" onclick="loadDoc()">
                        <img src="images/assettypes/oil_and_gas.png" alt="oil_and_gas" id="oilngas">
                    </a>
                        <div class="overlay">Oil and Gas</div>
                    </td>
                    <td>
                        <div class="fancyfade">
                        <a href="#" onclick="loadDoc()">
                            <img src="images/assettypes/maritime.png" alt="maritime_equip" id="maritime">
                        </a>
                            <div class="circlebase type1 fancyfade overlay"><div class="text">Maritime</div></div>
                        </div>
                    </td>
                    <td>
                        there won't be any split here. Cuz only one asset type details should be shown.
                    </td>
                    <td>
                        there won't be any split here. Cuz only one asset's location details should be shown.
                    </td>
                </tr>
            </table>
                                
        </div>
        
        <!--myFunction() script-->
        
			
            
    </body>
</html>