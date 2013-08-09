<?php
    include '../Layout.php';
    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "SuperAdministrator"){
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
                    <h1>Administrator Controls</h1>
                </div>

                <p class="lead">What would you like to do Mr. Administrator?</p>
                
                <a href="addGame.php" class="btn btn-block btn-info" style="font-size: 20px; padding: 10px;">Add a New Hockey Game</a>
                <a href="extract.php" class="btn btn-block btn-info" style="font-size: 20px; padding: 10px;">Extract a Hockey Game List</a>
                <a href="removePlayer.php" class="btn btn-block btn-info" style="font-size: 20px; padding: 10px;">Remove a Person From a Hockey Game</a>
                
                <br>
                
                <a href="addAnnouncement.php" class="btn btn-block btn-primary" style="font-size: 20px; padding: 10px;">Add an Announcement</a>
                <a href="selectUser.php" class="btn btn-block btn-primary" style="font-size: 20px; padding: 10px;">Promote Users</a>

                <br>

                <a href="../../PokemonCardSorter/mainPage.php" class="btn btn-block btn-inverse" style="font-size: 20px; padding: 10px;">Change to Pokemon Website</a>
                
                <?php
                    // Access to diary
                    if ($_SESSION['role'] == "SuperAdministrator"){
                        echo '<a href="../Diary/Diary.php" class="btn btn-block btn-inverse" style="font-size:  20px; padding: 10px;">Access Diary</a>
							';
                    }
                ?>
                
               
                <br>
            </div>
        </div>
        <div class="background"></div>
    </body>
</html>
