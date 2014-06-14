<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("das_users", $db);

    /* Post Form Handler */
    if(isset($_POST['submit'])){
        $opp = $_POST['opponent'];
        $shorty = $_POST['short'];

        $time = $_POST['time'];
        $time = strtotime($time);
        $time = date("Y/m/d H:i:s", $time);

        // Create the table of the new game
        $sql = "CREATE TABLE ".$shorty." (name varchar(50), ID varchar(50), attendance varchar(50))";
        mysql_query($sql,$db);

        // Add the game into the game list
        $sql = "INSERT INTO gameList VALUES ('".$opp."', '".$shorty."', '".$time."')";
        mysql_query($sql,$db);
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
        <div style="margin-top:  50px; width: 700px;" class="container">
            <div class="page-header">
                <h1>Add a Hockey Game</h1>
            </div>

            <div class="well well-large">
            <p class="lead">Current Games in Database</p>
                <?php            
                    $nextGame = "";
                    $query = "SELECT * FROM gameList";
                    $sql = mysql_query($query, $db);

                    // For each row in the query
                    while($row = mysql_fetch_array($sql))
                    {
                        // If the game is in the future and able to be registered for
                        echo '<p class="text-error" style="margin-left: 30px;">';
                        $nextGame = $row['opponent'];
                        echo $nextGame." - ";

                        // Convert the time to a readable capacity
                        $time = $row['date'];
                        $time = strtotime($time);
                        $time = date("m/d/Y H:i:s", $time);
                        echo $time;

                        echo '</p>';
                    }
                ?>
            <br><br>

            <form class="form-horizontal" method ="post" autocomplete="off">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Opponent Name</label>
                        <div class="controls">
                            <input type="text" name="opponent" id="opponent" placeholder="Enemy" required/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Database Name</label>
                        <div class="controls">
                            <input type="text" name="short" id="short" placeholder="Only Characters & Numbers" required/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Time of Game <br>YYYY/MM/DD HH:MM:00</label>
                        <div class="controls">
                            <input type="datetime" name="time" id="time" required/>
                        </div>
                    </div>
                          
                    <button class="btn btn-primary btn-large" name ="submit" value="Submit" style="margin-left: 50px;">Submit</button>
                 </fieldset>
            </form>
        </div>
        </div>
    </body>
</html>
