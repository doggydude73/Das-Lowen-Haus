<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    if ($_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }
    
    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("Diary", $db);
    date_default_timezone_set("America/Detroit");
    $currMod = $_SESSION['diaryDate'];
    $daySelect = mktime(date("H"), date("i"), date("s"),date("m"), date("d")+$currMod, date("Y"));
    $query = "SELECT * FROM entries ORDER BY Date DESC";
    $sql = mysql_query($query,$db);
    $currEntry = "";
    $time = "";

    while($row = mysql_fetch_array($sql))
    {
        if ($row['calendarDate'] == date("Y-m-d",$daySelect)){
            $currEntry = $row['Entry'];
            $time = $row['Date'];
        }
    }
    $time = strtotime($time);
    $time = date("F dS Y g:i:s A", $time);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top:  50px; width: 1000px;" class="container">
            <div class="well well-large">
                <!-- This is the buttons for the next and previous day-->
                <ul class="pager">
                    <?php
                        if (date("Y-m-d",$daySelect) == "2013-04-16" ){
                            echo '<li class="previous disabled">
                                  <a href="#">&larr; Previous Day</a>
                              </li>';
                        }else{
                        echo '<li class="previous">
                                  <a href="../Functions/previousDay.php">&larr; Previous Day</a>
                              </li>';
                        }

                        if (date("Y-m-d") == date("Y-m-d",$daySelect)){
                        echo '<li class="next disabled">
                                  <a href="#">Next Day &rarr;</a>
                              </li>';
                        }else{
                        echo '<li class="next">
                                  <a href="../Functions/nextDay.php">Next Day &rarr;</a>
                              </li>';
                        }
                    ?>
                </ul>

                <!--Content for the website-->
                <div class="well well-large">
                <?php
                    // If the date has been selected
                    echo $currEntry;
                    echo "<p style=\"padding:0px; margin:0px; text-align: right\">".$time."</p>";
                    echo "<p style=\"text-align: right\"> Andrew J. Suneson</p>";
                ?>
                </div>
                
            </div>
        </div>
    </body>
</html>
