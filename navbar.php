<!DOCTYPE html>
<?php
//include('config.php');

$currentPage = 0;
//global $curretPage;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
    <head>

        <meta charset="UTF-8">
        <title></title>
        <!--<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo 'Logged as: ' . $_SESSION['username'];
                        } else
                            echo 'Not logged';
                        ?>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <?php if(isset($_SESSION['username'])){ ?>
                    
                    <li><a href="form.php" class="active">Form</a></li>
                    <li><a href="my_data.php">My data</a></li>
                    <?php } ?>
                    <?php
                    if (isset($_SESSION['username'])) {
                        if ($_SESSION['username'] === 'Admin') {
                            echo '<li> <a href="control_panel.php">Users data</a></li>';
                        }
                    }
                    ?>
                </ul>   
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="my_data.php"><span class="glyphicon glyphicon-user"></span> Account </a></li>';
                    } else
                        echo '<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
                    ?>
                    
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log out </a></li>';
                    } else
                        echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                    ?>

                </ul>
            </div>
        </nav> 