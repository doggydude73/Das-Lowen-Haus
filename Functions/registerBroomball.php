<?php
    // Start up
    session_start();
    include 'sql.php';
    include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("broomball", $db);
    $errorMessage = "";
    $_SESSION['error'] = "";
    $name = $_SESSION['name'];

    // Get the form information
    $confirm = $_POST['compliance'];
    $emailAddr = $_POST['email'];
    $emailAddr = verify($emailAddr);
    if ($confirm == "on" && $emailAddr != ""){
        $pos1 = $_POST['pos1'];
        $pos2 = $_POST['pos2'];
        $pos3 = $_POST['pos3'];
        $hockeyExp = $_POST['hockey'];
        $soccerExp = $_POST['soccer'];
        $otherSportExp = $_POST['other'];
        $mcNairRes = $_POST['resident'];
        $returner = $_POST['returning'];
        $resValue = "";
        $returnVal = "";
        $hockey = "";
        $soccer = "";
        $otherSport = "";

        if ($mcNairRes == "on"){
            $resValue = "yes";
        }else{
            $resValue = "no";
        }
        
        if ($returner == "on"){
            $returnVal = "yes";
        }else{
            $returnVal = "no";
        }

        // Sanity check on invalid input for experience
            if ($hockeyExp == "0"){
                $hockey = "no";
            }else if ($hockeyExp == "1" || $hockeyExp == "2" || $hockeyExp == "3" || $hockeyExp == "4" ){
                $hockey = "yes";
            }else{
                $errorMessage = "Please input a valid argument for hockey experience.";
            }

            if ($soccerExp == "0"){
                $soccer = "no";
            }else if ($soccerExp == "1" || $soccerExp == "2" || $soccerExp == "3" || $soccerExp == "4" ){
                $soccer = "yes";
            }else{
                $errorMessage = "Please input a valid argument for soccer experience.";
            }

            if ($otherSportExp == "0"){
                $otherSport = "no";
            }else if ($otherSportExp == "1" || $otherSportExp == "2" || $otherSportExp == "3" || $otherSportExp == "4" ){
                $otherSport = "yes";
            }else{
                $errorMessage = "Please input a valid argument for other sport experience.";
            }

        // Sanity pass
        if ($errorMessage == ""){
            // Check to see if the user has already registered for broomball
            $registered = isRegistered($_SESSION['name'], $db);

            if ($registered == "0"){
                $query = "INSERT INTO registration VALUES ('$name','$pos1','$pos2','$pos3','$hockey','$hockeyExp','$soccer','$soccerExp','$otherSport','$otherSportExp','$returnVal','$resValue','$emailAddr','0')";
                mysql_query($query,$db);
            }else{
                $errorMessage = "You have already registered for the broomball season. Please contact the administrator if you wish to make changes.";
            }
        }

    }else{
        $errorMessage = "Please verify all areas of the form have been completed including #9 and #10";
    }

    if ($errorMessage != ""){
        $_SESSION['error'] =  $errorMessage;
        header("Location: ../Sports/broomball.php");
    }else{
        header("Location: ../Sports/SuccessfulRegistration.php");
    }
?>

