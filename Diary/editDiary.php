<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    date_default_timezone_set("America/Detroit");
    if ($_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
    }
    
    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    mysql_select_db("Diary", $db);
    $query = "SELECT * FROM entries ORDER BY calendarDate DESC LIMIT 1";
    $sql = mysql_query($query,$db);
    $currEntry = "Enter your day's events.";
    while($row = mysql_fetch_array($sql))
    {
        if ($row['calendarDate'] == date("Y-m-d")){
            $currEntry = $row['Entry'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php include '../navBar.php'; ?>
        <div style="margin-top:  100px;" class="container">
            <div class="well well-large">
                <div class="page-header">
                    <h1></h1>
                </div>
                <div class="well well-large">
                <form class="form-horizontal" method="post" autocomplete="off" action="../Functions/updateDiary.php" id="annForm">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label">Entry</label>
                        <div  class="controls">
                        <textarea name="entry" id="entry"rows="26"style="width: 600px"><?php echo $currEntry;?></textarea> 
                        </div>
                    </div>

                    <br>
                    <button class="btn btn-block btn-primary" name="submit" value="Submit" style="padding: 10px 0 10px 0">Submit</button>
                </fieldset>
            </form>
            </div>
            </div>
        </div>
    </body>
</html>
