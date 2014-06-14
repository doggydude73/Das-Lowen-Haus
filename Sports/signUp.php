<?php
    include '../Layout.php';

    $db = mysql_connect("localhost","root","jasmine");
    mysql_select_db("das_users", $db);

    $currTime = date("m/d/Y H:i:s");
    $cutOff = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+4, date("Y"));
    $cutOff = date("m/d/Y H:i:s", $cutOff);
    $futureGames = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+13, date("Y"));
    $futureGames = date("m/d/Y H:i:s", $futureGames);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Hockey Game Signup</title>
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top:  50px;" class="container">
            <div class="well well-large">
            <div class="page-header">
                <h1>Tech Hockey Games<small>  - Sign Up</small></h1>
            </div>
            
            <div class="well well-large">
            <form class="form-horizontal" method="post" autocomplete="off" action="hockeyRegister.php">
                <fieldset>
                    
                <?php if ($_SESSION['compliance'] == "no") {echo '<h2 style="color:red"> Please check the checkbox to proceed </h2>';}?>
                    
                    <legend>Registered Hockey Games</legend>
                    <br>
                    
                    <?php
                        $nextGame = "";
                        $query = "SELECT * FROM gameList";
                        $sql = mysql_query($query, $db);
        
                        // For each row in the query
                        while($row = mysql_fetch_array($sql))
                        {
                            $time = $row['date'];
                            $time = strtotime($time);
                            $time = date("m/d/Y H:i:s", $time);
                            $short = $row['shortName'];

                            // If the game is in the future and able to be registered for
                            if ($time < $futureGames && $time > $currTime){
                                $query2 = "SELECT * FROM ".$short." WHERE name = '".$_SESSION['name']."'";
                                $attendance = tableQuery($query2,"attendance","1",$db);

                            // Query if the user is attending the game in question
                            if ($attendance == 1){
                                echo '<p style="margin-left: 30px;" class="text-muted"><strong>';
                                $nextGame = $row['opponent'];
                                $time = strtotime($time);
                                $time = date("F dS Y g:i:s A",$time);
                                echo $nextGame." - ".$time;
                                echo '</strong></p>';
                            }
                        }
                    }
                ?>
                </fieldset>
                </form>
            </div>

            <div class="well well-large">
                 <form class="form-horizontal" method="post" autocomplete="off" action="hockeyRegister.php">
                    <fieldset>
                    <legend>Available Hockey Games</legend>
                    <br>
                    
                        <!--Below is the code for putting the available games as check boxes-->
                            <?php 
                                $nextGame = "";
                                $sql = mysql_query($query, $db);
                                while($row = mysql_fetch_array($sql))
                                {
                                    $time = $row['date'];
                                    $time = strtotime($time);
                                    $time = date("m/d/Y H:i:s", $time);
                                    $short = $row['shortName'];

                                    // If the game is in the alloted time range of registration
                                    if ($time < $futureGames && $time > $cutOff){
                                        $query2 = "SELECT * FROM ".$short." WHERE name = '".$_SESSION['name']."'";
                                        $attendance = tableQuery($query2,"attendance","1",$db);

                                        // Query if the user is not attending the game in question
                                        if ($attendance == 0){
                                            echo '<div class="control-group">';
                                            $nextGame = $row['opponent'];
                                            $time = strtotime($time);
                                            $time = date("F dS Y g:i:s A",$time);
           
                                            echo '<label class="checkbox">'.$nextGame.' - '.$time.'';
                                            echo '<input type="checkbox" style="margin: 0 10px 0 10px;" name='.$row['shortName'].' id='.$row['shortName'].' />';
                                            echo '</label><br>';
                                        }
                                    }
                                }
                            ?>

                        <!--Checkbox that the user clicks to show they are in compliance with the agreement of ordering-->
                        <label class="checkbox text-error"><strong>
                        <input style="margin: 0 10px 10px 10px;" type ="checkbox" name="compliance" id="compliance" required/>
                            I understand that by checking this box below, I am authorizing AJ Suneson to order my tickets to the game I have selected.  If I decide that I do not wish to have these tickets ordered, I am responsible for notifying him myself.
                        </strong></label>
                        
                        <br>
                        <button class="btn btn-primary btn-large" name="submit" value="Submit" style="margin-left: 30px;">Submit</button> 
                </fieldset>
            </form>
            </div>
            </div>
        </div>
    </body>
</html>
