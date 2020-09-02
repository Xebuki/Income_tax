<?php
//    include('head.php');
	
	$servername = "localhost";
	$username = "root";
	$passwd = "";
	$db_name = "podatki";
	
	$db_conn = new mysqli($servername, $username, $passwd ,$db_name) 
	or die("Connection failed: " . $db_conn->connect_error);

		
	
	

      
?>    

</html>



