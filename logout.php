<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

session_unset();
header("Refresh:0; index.php");
