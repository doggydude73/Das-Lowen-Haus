<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("das_users", $db);

    $username = $_SESSION['usernameSelect'];
    $newRank = "";
    $_SESSION['usernameSelect'] = "";

    switch ($_POST['rank']){
        case 'New':
            $newRank = "New";
            break;

        case 'User':
            $newRank = "User";
            break;

        case 'Operator':
            $newRank = "Operator";
            break;

        case 'Administrator':
            $newRank = "Administrator";
            break;

        default:
            break;
    }
    
    if ($newRank != ""){
        $query = "UPDATE userprofile SET Role = '".$newRank."' WHERE LoginId = '".$username."'";
        mysql_query($query,$db);
    }
    
    header("Location: ../mainPage.php");
?>