<?php
    include '../Layout.php';
    if ($_SESSION['role'] != "Administrator"  && $_SESSION['role'] != "Operator" && $_SESSION['role'] != "SuperAdministrator"){
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
                    <h1>Welcome Operators</h1>
                </div>
                <p class="lead">What can I help you with today operator?</p>
            <br><br>

            <a href="../../PokemonCardSorter/mainPage.php" class="btn btn-large btn-primary span3">Change to Pokemon Website</a>
            <a href="selectUser.php" class="btn btn-large btn-primary span3 offset0">Promote Users</a>
            <a href="addAnnouncement.php" class="btn btn-large btn-primary span3 offset0">Add an Announcement</a>
                    
            <br><br><br>
            </div>
        </div>
    </body>
</html>
