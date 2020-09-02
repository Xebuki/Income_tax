<?php
	include('head.php');
        
?>
        <form action="login_check.php" method="POST">
		
		<div id = "form_div_login">
                <h2> Please log in </h2>
		<table id = "form_table">
                    <input type = "text" name = "login" required="" placeholder="PESEL">
                    <input type = "password" name = "password" required="" placeholder="password">
		
		</table>
		<input type="submit" class="btn btn-success" name="zaloguj" value="Log in"/>
                
        </div>
