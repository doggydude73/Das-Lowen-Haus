<?php
    session_start();

    if ($_POST['compliance'] == "on"){
        include '../Layout.php';

        $db = mysql_connect("localhost","root","jasmine");
        mysql_select_db("das_users", $db);

        $currTime = date("m/d/Y H:i:s");
        $cutOff = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+4, date("Y"));
        $cutOff = date("m/d/Y H:i:s", $cutOff);
        $futureGames = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+13, date("Y"));
        $futureGames = date("m/d/Y H:i:s", $futureGames);

        $nextGame = "";
        $query = "SELECT * FROM gameList";
        $sql = mysql_query($query, $db);
        while($row = mysql_fetch_array($sql))
        {
            $time = $row['date'];
            $time = strtotime($time);
            $time = date("m/d/Y H:i:s", $time);

            // If the game is in the alloted time range of registration
            if ($time < $futureGames && $time > $cutOff){
                $short = $row['shortName'];
                $currBox = $_POST[$short];
            
                if ($currBox == "on"){
                    $query2 = "SELECT * FROM ".$short." WHERE name = '".$_SESSION['name']."'";
                    $notGoing = tableQuery($query2, "attendance", "0", $db);
                
                    if ($notGoing == 1){
                        $query = "UPDATE ".$short." SET attendance = 1 WHERE name = '".$_SESSION['name']."'";
                        mysql_query($query,$db);
                    }else{
                        /* Get the card ID of the current user */
                        $id = getId($db, $_SESSION['user']);
                    
                        // Swap back to the hockey database
                        mysql_select_db("das_users", $db);

                        // Insert the user into the correct game as going
                        $query = "INSERT INTO ".$short." VALUES ('".$_SESSION['name']."','$id', 1)";
                        mysql_query($query,$db);
                    }
                }
            }
        }
        $_SESSION['compliance'] = "yes";
    }else{
        $_SESSION['compliance'] = "no";
    }

    header("Location: signUp.php");

?>


