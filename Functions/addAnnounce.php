<?php
    // Start up
    session_start();
    include 'sql.php';
	include '../databaseConnection.php';

    date_default_timezone_set("America/Detroit");
    $time = date("Y/m/d H:i:s");
	$db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("das_users", $db);

    // Prepare announcement
    $announcement = $_POST['announcement'];
    $announcement = verify($announcement);
    $privacy = $_POST['privacy'];
    $creator = $_SESSION['name'];
    $role = $_SESSION['role'];
    
    // Add the announcement to the database
    if ($role == "Administrator" || $privacy == "Private" || $role == "SuperAdministrator"){
        // User is either an admin or posting privately
        $query = "INSERT INTO announce VALUES ('".$announcement."','".$time."','".$creator."','".$privacy."','Yes')";
        mysql_query($query,$db);
    }  else{
        // User is an operator posting publicly... therefore announcement is pending approval by an administrator
        $query = "INSERT INTO announce VALUES ('".$announcement."','".$time."','".$creator."','".$privacy."','No')";
        mysql_query($query,$db);
    }

    // Redirect to the main page
    header("Location: ../mainPage.php");
?>