<?php
include('head.php');
include('connection.php');
include('functions.php');
include('selects.php');
include('export.php');


$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$pesel = $_POST['pesel'];
$nip = $_POST['nip'];
$rok_obrachunkowy = $_POST['rok_obrachunkowy'];
//	$podstawa_opodatkowania = $_POST['podstawa_opodatkowania']; 
$przychod = floatval($_POST['przychod']);
$skladki_zdrowotne = floatval($_POST['skladka_ubezpieczenia']);
$koszt_przychodu = floatval($_POST['koszt_przychodu']);

$dochod = $przychod - $koszt_przychodu;
$podstawa = $dochod - $skladki_zdrowotne;

if ($przychod < 0) {
    $przychod = 0;
}

if ($dochod < 0) {
    $dochod = 0;
}

if ($podstawa < 0) {
    $podstawa = 0;
}

if ($rok_obrachunkowy == 2017) {
    $podatek = wysokosc_podatku(podatek_2017($podstawa));
}

if ($rok_obrachunkowy == 2018) {
    $podatek = wysokosc_podatku(podatek_2018($podstawa));
}
if ($rok_obrachunkowy == 2019) {
    $podatek = wysokosc_podatku(podatek_2019($podstawa));
}



$insert_podstawowe = "INSERT INTO dane_podstawowe (imie, nazwisko, PESEL, NIP)
					VALUES (
					'$imie', 
					'$nazwisko', 
					$pesel, 
					$nip
					)";

$insert_podatkowe = "INSERT INTO dane_podatkowe (podstawa,
                                                PESEL,
                                                rok_obrachunkowy,
                                                przychod,
                                                dochod,
                                                koszt_przychodu,
                                                skladki_zdrowotne,
                                                podatek)
                                VALUES (
                                '$podstawa',
                                '$pesel',
                                $rok_obrachunkowy,
                                $przychod,
                                $dochod,
                                $koszt_przychodu,
                                $skladki_zdrowotne,
                                $podatek
                                )";

$select_check = "SELECT 
                    dane_podstawowe.PESEL,
                    dane_podatkowe.rok_obrachunkowy
                    FROM dane_podstawowe
                    RIGHT JOIN dane_podatkowe
                    ON dane_podstawowe.pesel = dane_podatkowe.pesel
                    WHERE dane_podatkowe.PESEL = $pesel;";

$select_podstawowe = " SELECT 
                    imie,
                    nazwisko,
                    PESEL,
                    NIP
                    FROM dane_podstawowe
                    WHERE PESEL = $pesel;";

$select_podatkowe = " SELECT
                    dane_podatkowe.podstawa,
                    dane_podstawowe.PESEL,
                    dane_podatkowe.rok_obrachunkowy,
                    dane_podatkowe.przychod,
                    dane_podatkowe.dochod,
                    dane_podatkowe.koszt_przychodu,
                    dane_podatkowe.skladki_zdrowotne,
                    dane_podatkowe.podatek
                    FROM dane_podstawowe
                    RIGHT JOIN dane_podatkowe
                    ON dane_podstawowe.pesel = dane_podatkowe.pesel
                    WHERE dane_podatkowe.PESEL = $pesel;";


//sprawdzanie czy użytkownik o danym peselu istnieje juz w bazie
//$year = 0;
$_SESSION['year']=false;
if ($result_check = mysqli_query($db_conn, $select_check)) {
    if (mysqli_num_rows($result_check) == 0) {
        if (mysqli_query($db_conn, $insert_podstawowe)) {
            echo '#podstawowe added <br />';
        } else {
            echo 'Error: ' . $insert_podstawowe . '<br />' . mysqli_error($db_conn);
        }

        if (mysqli_query($db_conn, $insert_podatkowe)) {
            echo '#podatkowe added <br />';
        } else {
            echo 'Error: ' . $insert_podatkowe . '<br />' . mysqli_error($db_conn);
        }
    } else {
        while ($row = mysqli_fetch_array($result_check)) {

            if ($row['rok_obrachunkowy'] == $rok_obrachunkowy) {
                $_SESSION['year'] = true;
                echo '#rok istnieje <br />';
            }
        }
        if ($_SESSION['year'] == false ) {
            if (mysqli_query($db_conn, $insert_podatkowe)) {
                echo '#podatkowe added <br />';
                $_SESSION['year'] = false;
            } else {
                echo 'Error: ' . $insert_podatkowe . '<br />' . mysqli_error($db_conn);
            }
        }
    }
}
echo '<div class = "table_div">';
//wypisywanie danych do tabeli z bazy danych			
if ($result = mysqli_query($db_conn, $select_podstawowe)) {
    if (mysqli_num_rows($result) > 0) {

        echo '<table class = "db">';
        echo "<tr>";
        echo "<th><center>Imię</th>";
        echo "<th><center>Nazwisko</th>";
        echo "<th><center>PESEL</th>";
        echo "<th><center>NIP</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td>" . $row['imie'] . "</td>";
            echo "<td>" . $row['nazwisko'] . "</td>";
            echo "<td>" . $row['PESEL'] . "</td>";
            echo "<td>" . $row['NIP'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "Nie znaleziono rekordow";
    }
} else {
    
}
//wypisywanie danych do tabeli z bazy danych
if ($result = mysqli_query($db_conn, $select_podatkowe)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="db">';
        echo "<tr>";
        echo "<th><center>Rok obrachunkowy</th>";
        echo "<th><center>Podstawa opodatkowania</th>";
        echo "<th><center>Przychod</th>";
        echo "<th><center>Dochod</th>";
        echo "<th><center>Skladka zdrowotna(9%)</th>";
        echo "<th><center>Koszt przychodu</th>";
        echo "<th><center>Do zapłaty</th>";
        echo "</tr>";
    } else {
        
    }
    while ($row = mysqli_fetch_array($result)) {

        echo "<tr>";
        echo "<td>" . $row['rok_obrachunkowy'] . "</td>";
        echo "<td>" . $row['podstawa'] . "</td>";
        echo "<td>" . $row['przychod'] . "</td>";
        echo "<td>" . $row['dochod'] . "</td>";
        echo "<td>" . $row['skladki_zdrowotne'] . "</td>";
        echo "<td>" . $row['koszt_przychodu'] . "</td>";
        echo "<td>" . $row['podatek'] . "</td>";

        echo "</tr>";
    }
    echo "</table>";
    echo "<div>";
    mysqli_free_result($result);
}





echo'	<form method="post" action="export.php">
		<input type="submit" name="export" class="btn btn-success" value="Eksportuj" />
		</form>';






mysqli_close($db_conn);
?>    

</html>


