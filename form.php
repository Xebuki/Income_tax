<?php
include('head.php');
include('selects.php');
include('connection.php');

if (isset($_SESSION['username'])) {
    if ($result = mysqli_query($db_conn, $select)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
    } else {
        echo'brak połączenia z bazą';
    }
} else {
    echo'Użytkownik niezalogowany!';
}


echo '<body>
			</body>
    
		<form action="summary.php" method="POST">
		
		<div id = "form_div_form">
		<table class = "table_form">
		<tr> <td> Imie </td> <td> <input type = "text" name = "imie" maxlength = 25 value="'.$row["imie"].'"> </td></tr>
		<tr> <td> Nazwisko </td> <td> <input type = "text" name = "nazwisko" maxlength = 30 value="'.$row["nazwisko"].'"> </td> </tr>
		<tr> <td> PESEL </td> <td> <input type = "text" name = "pesel" maxlength = 11 value="'.$row["PESEL"].'"> </td> </tr>
		<tr> <td> NIP </td> <td> <input type = "text" name = "nip" maxlength = 10 value="'.$row["NIP"].'"> </td> </tr>
                <tr> <td> Rok obrachunkowy </td>
                <td>
                <select name="rok_obrachunkowy">
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                </select> 
                <tr> <td>
                <tr> <td> Przychod </td> <td> <input type = "float" name = "przychod" min=0></td> </tr>
                <tr> <td> Koszt utrzymania przychodu </td> <td> <input type = "float" name = "koszt_przychodu"></td> </tr>
                <tr> <td> Składka ubezpieczenia społecznego </td> <td> <input type = "float" name = "skladka_ubezpieczenia"></td> </tr>
		
		</table>
		<input type="submit" class="btn btn-success" name="send" value="wyslij"/>
                </div>	
		
        </form>
		'
?>    

</html>


