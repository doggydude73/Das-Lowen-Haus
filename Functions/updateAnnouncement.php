<?php
    // Start up
    session_start();
    include 'sql.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("das_users", $db);

    // Update any potential announcements to displayable
    $query = "SELECT * FROM announce WHERE approval = 'No' ORDER BY time DESC";
    $sql = mysql_query($query,$db);
    $counter = 0;

    while($row = mysql_fetch_array($sql))
    {
        // Get the check boxes
        $currApp = 'ann'.$counter;
        $currDeny = 'deny'.$counter;
        $appBox = $_POST[$currApp];
        $denyBox = $_POST[$currDeny];

        // Determine which action to take.
        if ($denyBox == "on"){
            $announcement = $row['news'];
            $announcement = verify($announcement);

            $query = "DELETE FROM announce WHERE news = '".$announcement."'";
            mysql_query($query,$db);
        } else if ($appBox == "on"){
            $announcement = $row['news'];
            $announcement = verify($announcement);

            $query = "UPDATE announce SET approval = 'Yes' WHERE news = '".$announcement."'";
            mysql_query($query,$db);
        }
        $counter = $counter  + 1;
    }

    // Redirect to the main page
    header("Location: ../mainPage.php");
?>
