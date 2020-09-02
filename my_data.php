<?php

include('head.php');
include('connection.php');
//include('functions.php');
//include('selects.php');
include('export.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['username'])) {

    $pesel = $_SESSION['username'];
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
    echo '<div class = "table_div">';
    if ($result = mysqli_query($db_conn, $select_podstawowe)) {
        if (mysqli_num_rows($result) > 0) {

            echo '<table class="db">';
            echo "<tr>";
            echo "<th><center>Imie</th>";
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
            echo "<center><h1>Brak danych podatkowych!</h1></center>";
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
    echo'	<form method="post" action="form.php">
		<input type="submit" name="form" class="btn btn-success" value="Form" />
		</form>';
    echo'	<form method="post" action="export.php">
		<input type="submit" name="export" class="btn btn-danger" value="Eksportuj" />
		</form>';
} else {
    echo'<div id="form_div_login">';
    echo"<h1>Użytkownik nie zalogowany!</h1>";
    header("Refresh:3; index.php");
}