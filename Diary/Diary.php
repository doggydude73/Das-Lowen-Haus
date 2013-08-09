<?php
    include '../Layout.php';
    if ($_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top:  100px;" class="container">
            <div class="well well-large">
                <div class="page-header">
                    <h1>Diary Controls</h1>
                </div>

                <p class="lead">AJ, would you like to read or write into your diary?</p>

                <a href="editDiary.php" class="btn btn-block btn-info" style="font-size: 20px; padding: 10px;">Edit the Daily Entry</a>
                <a href="readDiary.php" class="btn btn-block btn-info" style="font-size: 20px; padding: 10px;">Read Diary</a>

            </div>
        </div>
        <div class="background"></div>
    </body>
</html>
