
<?php  
//export.php  
$servername = "localhost";
	$username = "root";
	$db_name = "podatki";
	
$connect = mysqli_connect("localhost", "root", "", "podatki");

$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT
                            dane_podstawowe.imie,
                            dane_podstawowe.nazwisko,
                            dane_podstawowe.PESEL,
                            dane_podstawowe.NIP,
                            dane_podatkowe.podstawa,
                            dane_podatkowe.rok_obrachunkowy,
                            dane_podatkowe.przychod,
                            dane_podatkowe.dochod,
                            dane_podatkowe.koszt_przychodu,
                            dane_podatkowe.skladki_zdrowotne
                            FROM dane_podstawowe
                            JOIN dane_podatkowe
                            ON dane_podstawowe.pesel = dane_podatkowe.pesel
							WHERE dane_podstawowe.pesel = '" . $_SESSION['username'] . "'
                            ;";
						
						
 $result = mysqli_query($connect, $query);
 var_dump(mysqli_error($connect));
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
	<th>Imie</th>  
	<th>Nazwisko</th>  
	<th>PESEL</th>  
	<th>NIP</th>
	<th>rok_obrachunkowy</th>
	<th>podstawa_opodatkowania</th>
	<th>dochod</th>
	<th>koszt_przychodu</th>
	<th>skladka_ubezpieczenia</th>
        <th>podatek</th>
	
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
	<td>'.$row["imie"].'</td>  
	<td>'.$row["nazwisko"].'</td>  
	<td>'.$row["PESEL"].'</td>  
	<td>'.$row["NIP"].'</td>  
	<td>'.$row["rok_obrachunkowy"].'</td>
        <td>'.$row["podstawa"].'</td>
        <td>'.$row["przychod"].'</td>
        <td>'.$row["dochod"].'</td>
        <td>'.$row["koszt_przychodu"].'</td>
        <td>'.$row["skladki_zdrowotne"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Twoje_dane_podatkowe.xls');
  echo $output;
  header("refresh:0; summary.php");
 }
}

?>