<?php
	include('head.php');
        include('connection.php');
//        include('selects.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//        $my_json = 'user.json';
//        $jsondata = file_get_contents($my_json);
//        $login_data = json_decode($jsondata, true);
        
        $select_admin = " SELECT
                            dane_podstawowe.imie,
                            dane_podstawowe.nazwisko,
                            dane_podstawowe.PESEL,
                            dane_podstawowe.NIP,
                            dane_podatkowe.podstawa,
                            dane_podatkowe.rok_obrachunkowy,
                            dane_podatkowe.przychod,
                            dane_podatkowe.dochod,
                            dane_podatkowe.koszt_przychodu,
                            dane_podatkowe.skladki_zdrowotne,
                            dane_podatkowe.podatek
                            FROM dane_podstawowe
                            JOIN dane_podatkowe
                            ON dane_podstawowe.pesel = dane_podatkowe.pesel
                            ;";

if(isset($_SESSION['username'])){
            if($_SESSION['username'] === 'Admin') {
                
               

                if($result = mysqli_query($db_conn, $select_admin)){
                    if(mysqli_num_rows($result) > 0){
                        //echo $result;
                        echo '<div class = "table_div">';
                        echo '<table class="db">';
                        echo "<tr>";
                            echo "<th>Imię</th>";
                            echo "<th>Nazwisko</th>";
                            echo "<th>PESEL</th>";
                            echo "<th>NIP</th>";
                            echo "<th>Podstawa opodatkowania</th>";
                            echo "<th>Rok obrachunkowy</th>";
                            echo "<th>Przychod</th>";
                            echo "<th>Dochod</th>";
                            echo "<th>Koszt przychodu</th>";
                            echo "<th>Skladki zdrowotne</th>";
                            echo "<th>Do zapłaty</th>";
                        echo "</tr>";       
                    
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['imie'] . "</td>";
                        echo "<td>" . $row['nazwisko'] . "</td>";
                        echo "<td>" . $row['PESEL'] . "</td>";
                        echo "<td>" . $row['NIP'] . "</td>";
                        echo "<td>" . $row['podstawa'] . "</td>";
                        echo "<td>" . $row['rok_obrachunkowy'] . "</td>";
                        echo "<td>" . $row['przychod'] . "</td>";
                        echo "<td>" . $row['dochod'] . "</td>";
                        echo "<td>" . $row['koszt_przychodu'] . "</td>";
                        echo "<td>" . $row['skladki_zdrowotne'] . "</td>";
                        echo "<td>" . $row['podatek'] . "</td>";
                        echo "</tr>";
                                        }
                    echo "</table>";	
                    echo "<div>";
                    mysqli_free_result($result);
                    } 
                    else{
                        echo "Nie znaleziono rekordow";
                        echo $result;
                    }
                } 
                exit();
            }
        else {
           echo 'unknown user';
                }
        
}    
      //  }
    
   // echo $user_name;
    
?>