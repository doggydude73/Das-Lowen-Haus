<?php
    
    include '../Layout.php';
    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location:../ mainPage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>

    </body>
</html>
