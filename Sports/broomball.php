<?php
    include '../Layout.php';
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
        <div class="well well-large">

            <?php
                    // Echo any errors that occured during registration
                    if ($_SESSION['error'] != ""){
                        echo '<h1 style="color: red">';
                        echo $_SESSION['error'];
                        echo '</h1>';
                    }
            ?>
            <div class="page-header">
                <h1>Broomball Registration <small>- Season 2014</small></h1>
            </div>
            
            <h3>Below is the form for which you can register for the season to be on an on-campus team with Das Lowen Haus.</h3>
            
            <div class="well well-large">
            
            <p class="lead text-error">
                <strong>DISCLAIMER</strong> Just because you register with us and you are an off-campus resident does not guarantee you a slot on a team with us.  This simply means that you show interest in joining us and that you would like to be considered should there be slots (or teams willing) to accept off-campus members.
            </p>

            <?php echo '<form class="form-horizontal" method="post" autocomplete="off" action="'.$pathRoot.'Functions/registerBroomball.php">'; ?>
            <fieldset>
            <legend></legend><br>

            <div class="control-group">
            <label class="control-label">Desired Position 1</label>
            <div class="controls">
            <select name="pos1">
                <option value="Goalie">Goalie</option>
                <option value="Defense">Defense</option>
                <option value="Center">Center</option>
                <option value="Winger">Winger</option>
            </select>
            </div>
            </div>
            
            <div class="control-group">
            <label class="control-label">Desired Position 2</label>
            <div class="controls">
            <select name="pos2">
                <option value="None">None</option>
                <option value="Goalie">Goalie</option>
                <option value="Defense">Defense</option>
                <option value="Center">Center</option>
                <option value="Winger">Winger</option>
            </select>
            </div>
            </div>
            
            <div class="control-group">
            <label class="control-label">Desired Position 3</label>
            <div class="controls">
            <select name="pos3">
                <option value="None">None</option>
                <option value="Goalie">Goalie</option>
                <option value="Defense">Defense</option>
                <option value="Center">Center</option>
                <option value="Winger">Winger</option>
            </select>
            </div>
            </div>
            <br>

            <p style="text-align: center; font-size:  19px;"><b> Do you have an experience playing any of the following sports and if so, for each list the highest level of play.</b></p>
            <pre style="text-align:  center; font-size: 16px;" class="well well-small">0 - No Experience      1 - Pre-HighSchool      2 - JV      3 - Varisty      4 - College Club</pre>
            
            <div class="control-group">
                <label class="control-label">Hockey</label>
            <div class="controls">
                <input type="number" name="hockey" min="0" max="4" value="0">
            </div>
            </div>

            <div class="control-group">
                <label class="control-label">Soccer</label>
            <div class="controls">
                <input type="number" name="soccer" min="0" max="4" value="0">
            </div>
            </div>

            <div class="control-group">
                <label class="control-label">Other Team Sports</label>
            <div class="controls">
                <input type="number" name="other" min="0" max="4" value="0">
            </div>
            </div>

            <div class="control-group">
                <label class="control-label">Current McNair Resident</label>
            <div class="controls">
                <input type="checkbox" name="resident" id="resident">
            </div>
            </div>

            <div class="control-group">
                <label class="control-label">Returning MTU Resident</label>
            <div class="controls">
                <input type="checkbox" name="returning" id="returning">
            </div>
            </div>

            <div class="control-group">
                <label class="control-label">MTU Email Address</label>
            <div class="controls">
                <input class="input-large" placeholder="email@mtu.edu" type="email" name="email" id="email" required>
            </div>
            </div>          
            
            <p style="margin: 25px 30px 0px 30px; font-size: 16px;"><b>By checking the box below, you understand that you are signing up for the 2014 season of broomball here with Das Lowen Haus, which has no direct affiliation with Broomball or MTU directly.  If you are selected to be on a team, you understand that you are required to pay the 20$ fee regardless of any circumstance that arrises that would cause you to withdraw from your team.  The only exception is the withdraw date before payment is due.  If you wish to drop after payment has been made, you are responsible for notifying your captain.  Also, by signing up, you agree to make atleast 50% of the games you have signed up for and are responsible for notifying your captain in a timely fashion, ie 4+ days in advance, if you can not make it to the game.</b></p>
            <input style="margin: 0 0 0 30px" type="checkbox" name="compliance" id="compliance" required>
            
            <br><br><br> 

            <button style="margin-left:  30px;" class="btn btn-primary btn-large">Submit</button>
            </fieldset>
            </form>
            </div>
        </div>
        </div>
    </body>
</html>
