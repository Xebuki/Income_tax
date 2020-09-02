<?php

//include_once('summary.php');

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
                            dane_podatkowe.skladki_zdrowotne
                            FROM dane_podstawowe
                            JOIN dane_podatkowe
                            ON dane_podstawowe.pesel = dane_podatkowe.pesel
                            ;";
$select = " SELECT
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