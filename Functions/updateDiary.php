<?php
    // Start up
    session_start();
    include 'sql.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("Diary", $db);
    date_default_timezone_set("America/Detroit");

    // Query for existing entry
    $query = "SELECT * From entries";
    $sql = mysql_query($query,$db);
    $entry = $_POST['entry'];
    $entry = verify($entry);
    $result = tableQuery($query, "calendarDate", date("Y-m-d"), $db);
    $_SESSION['diaryDate'] = 0;
   
    // Determine whether to add or update the diary
    if ($result == 1){
        // The diary already contained an entry so update it

        // TODO Update Entry and the edited time
        $query = "UPDATE entries SET Entry = '".$entry."' WHERE calendarDate = '".date("Y-m-d")."'";
        mysql_query($query,$db);

        $query = "UPDATE entries SET Date = '".date("Y/m/d H:i:s")."' WHERE calendarDate = '".date("Y-m-d")."'";
        mysql_query($query,$db);

    }else{
        // Add a new entry into the diary
        $query = "INSERT INTO entries VALUES ('".date("Y/m/d H:i:s")."','".$entry."','".date("Y/m/d")."')";
        mysql_query($query,$db);
    }

    // Redirect to the diary reader
    header("Location: ../Diary/readDiary.php");
?>