<?php

include('connection.php');
include('head.php');

$login = $_POST['login'];
$password = $_POST['password'];
//$login = 'Admin';
//$password = 1;

$select_check = " SELECT 
                    PESEL,
                    password
                    FROM uzytkownicy
                    WHERE PESEL = $login;";

$insert_user = "INSERT INTO uzytkownicy (  PESEL,
                                                password)
                                VALUES (
                                $login,
                                $password
                                )";

echo'<div id="form_div_login">';
if (is_numeric($login)) {
    if (strlen($login) == 11) {
        if ($result = mysqli_query($db_conn, $select_check)) {
            if (mysqli_num_rows($result) == 0) {
                if (mysqli_query($db_conn, $insert_user)) {
                    echo"<h1>Pomyślnie zarejestrowano użytkownika!</h1>";
                    echo"Za chwile zostaniesz przekierowany do ekranu logowania!";
                    header("Refresh:13; login.php");
                }
            } else {
                echo '<h1>Login istnieje w bazie!</h1>';
                echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
                header("Refresh:3; signup.php");
            }
        } else {
            echo '<h1>Błąd połączenia z bazą</h1>';
            echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
            header("Refresh:3; signup.php");
        }
    } else {
        echo '<h1>Pesel składa się z 11 cyfr !!!</h1>';
        echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
        header("Refresh:3; signup.php");
    }
} else {
    echo '<h1>Pesel składa się z cyfr !!!</h1>';
    echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
    header("Refresh:3; signup.php");
}
