<?php
    include '../Layout.php';
	include '../databaseConnection.php';
    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "Operator" && $_SESSION['role'] != "SuperAdministrator"){
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
        <div style="margin-top:  50px; width: 600px;" class="container well well-large">
            <div class="page-header">
                <h1>Add Announcement <small> to Main Page</small></h1>
            </div>

            <p>Please type whatever announcement you wish to make below to add it to the main page.</p>
            <p class="text-error">Please note, if you are not an administrator and make a public announcement, it will pend until an administrator approves it so <strong>please do not send multiple copies of your announcement to the server.</strong></p>
            <div class="well well-large">
            <form class="form-horizontal" method="post" autocomplete="off" action="../Functions/addAnnounce.php" id="annForm">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label">Announcement</label>
                        <div  class="controls">
                        <textarea style="max-width: 350px; width: 350px;" rows="4" name="announcement" id="announcement" required></textarea> 
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Protection</label>
                        <div class="controls">
                            <select name="privacy" style="width: auto;">
                                <option value="Public">Public</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-block btn-primary" name="submit" value="Submit" style="padding: 10px 0 10px 0">Submit</button>
                </fieldset>
            </form>
            </div>
        </div>
    </body>
</html>
