<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }
    
    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("das_users", $db);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top:  50px;" class="container">
            <h1>Approve Announcements</h1>
            <form method="post" autocomplete="off" action="../Functions/updateAnnouncement.php">
                <fieldset>
                    <legend>Approve any Announcement Below</legend>
                    <ol>
                        <?php
                            $query = "SELECT * FROM announce WHERE approval = 'No' ORDER BY time DESC";
                            $sql = mysql_query($query,$db);
                            $counter = 0;

                            // Get the top five announcements
                            while($row = mysql_fetch_array($sql))
                            {
                                echo '<li>';
                                $announcement = $row['news'];
                                $creator = $row['creator'];
                                $time = $row['time'];
                                $time = strtotime($time);
                                $time = date("F dS Y g:i:s A", $time);

                                echo "<div id=\"single\">";
                                echo "<p style=\"text-align: right\">".$time."</p>";
                                echo "<p style=\"text-align: justify\">".$announcement."</p>";
                                echo "<p style=\"text-align: right\">".$creator."</p>";
                                echo "</div>";

                                echo '<label> Approve </label>';
                                echo '<input type = "checkbox" name="ann'.$counter.'" id="ann'.$counter.'" />';

                                echo '<label> Deny </label>';
                                echo '<input type = "checkbox" name="deny'.$counter.'" id="deny'.$counter.'" />';

                                echo '</li>';
                                $counter = $counter  + 1;
                            }
                        ?>
                        <li>
                            <p><input type="submit" name ="submit" value="Submit"/></p>
                        </li>
                    </ol>
                </fieldset>
            </form>
        </div>
        <div class="background"></div>
    </body>
</html>
