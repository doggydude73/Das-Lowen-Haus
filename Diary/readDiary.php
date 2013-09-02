<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    if ($_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }

	if(!isset($_SESSION['SID']))
	{
		$_SESSION['SID'] = 0;
	}
    
    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("Diary", $db);
    date_default_timezone_set("America/Detroit");
	
    $query = "SELECT * FROM entries ORDER BY Date DESC";
    $sql = mysql_query($query,$db);
    $currEntry = "";
    $time = "";

    while($row = mysql_fetch_array($sql))
    {
		// Check to see if the diary page has just been opened
		if ($_SESSION['SID'] == 0)
		{
			// Get the most current entry and break from the loop
			$currEntry = $row['Entry'];
			$time = $row['Date'];
			$_SESSION['SID'] = $row['SID'];
			$_SESSION['maxSID'] = $row['SID']; // Save the largest SID to make sure the user can't advance past his newest entry
			break;
		}
		elseif($_SESSION['SID'] == $row['SID'])
		{
			// Find the row that matches the current SID and report its information and break from the loop
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
                        if ($_SESSION['SID'] == "1" ){
                            echo '<li class="previous disabled">
                                  <a href="#">&larr; Previous Day</a>
                              </li>';
                        }else{
                        echo '<li class="previous">
                                  <a href="../Functions/previousDay.php">&larr; Previous Day</a>
                              </li>';
                        }

                        if ($_SESSION['SID'] == $_SESSION['maxSID']){
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
