<?php
	include('head.php');
        $login_data = json_decode(file_get_contents("user.json"));
?>
        <form action="signup_check.php" method="POST">
            		
		<div id = "form_div_login">
                <h1>Please Sign Up!</h1>        
		<table id = "form_table">
                    <input type = "text" maxlength="11" name = "login" required="" placeholder="PESEL">
                    <input type = "password" name = "password" required="" placeholder="password">
		</table>
		<input type="submit" class="btn btn-success" name="zaloguj" value="Sign in"/>
                </div>	
		
        </form>