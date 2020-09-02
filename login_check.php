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
                    WHERE PESEL = '$login';";

$insert_podatkowe = "INSERT INTO uzytkownicy (  PESEL,
                                                password)
                                VALUES (
                                $login,
                                $password
                                )";
echo'<div id="form_div_login">';
if ($login === 'Admin') {
    if ($result = mysqli_query($db_conn, $select_check)) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($login == $row['PESEL'] AND $password == $row['password']) {
                echo'Pomyślnie zalogowano';
                $_SESSION['username'] = $login;
                header('Location: main_page.php');
            }echo 'Błędny login lub hasło';
        } else {
            echo'brak rekordów';
        }
    } else {
        echo'brak połączenia z bazą';
    }
}

if (is_numeric($login)) {
    if (strlen($login) == 11) {
        if ($result_check = mysqli_query($db_conn, $select_check)) {
            if (mysqli_num_rows($result_check) > 0) {
                $row = mysqli_fetch_assoc($result_check);
                if ($login == $row['PESEL'] AND $password == $row['password']) {
                    $_SESSION['username'] = $login;
                    echo"<h1>Pomyślnie zalogowano użytkownika!</h1>";
                    echo"Za chwile zostaniesz przekierowany do strony głównej!";
                    header("Refresh:3; main_page.php");
                } else {
                    echo '<h1>Błędne hasło uzytkownika</h1>';
                    echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
                    header("Refresh:3; login.php");
                }
            } else {
                echo '<h1>Błędny login</h1>';
                echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
                header("Refresh:3; login.php");
            }
        } else {
            echo '<h1>Błąd połączenia z bazą</h1>';
            echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
            header("Refresh:3; login.php");
        }
    } else {
        echo '<h1>Pesel składa się z 11 cyfr !!!</h1>';
        echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
        header("Refresh:3; login.php");
    }
} else {
    echo '<h1>Pesel składa się z cyfr</h1>';
    echo"Za chwile zostaniesz przekierowany ponownie do ekranu logowania!";
    header("Refresh:3; login.php");
}
