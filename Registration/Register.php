<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUser,$dbPass);
    if (!$db){die('Could not connect to database');}

    function redirection($website){
        header($website);
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
       
            <div class="container" style="text-align: center; margin-top: 100px;">
            
         <div style="width: 420px;" class="container well well-small">
            <?php
                $user;
                $password;
                $confirmPassword;
                $ErrorMessage = "";
                $rolePassword;
                $cardID;
                $cardIDName;

                if(isset($_POST['submit'])){
                    $user = $_POST['user'];
                    $user = verify($user);
                    $password = $_POST['password'];
                    $password = verify($password);
                    $confirmPassword =$_POST['confirmPassword'];
                    $confirmPassword = verify($confirmPassword);
                    $rolePassword = $_POST['rolePassword'];
                    $rolePassword = verify($rolePassword);
                    $cardID = $_POST['cardID'];
                    $cardID = verify($cardID);
                    $cardIDName = $_POST ['idName'];
                    $cardIDName = verify($cardIDName);

                    if ($password != $confirmPassword){
                        $ErrorMessage = "Password and confirmation do not match.";
                        echo $ErrorMessage;}

                    if (strlen($cardID) != 16){
                        $ErrorMessage = "<p style='color:red'>Please enter a valid card ID number.</p>";
                        echo $ErrorMessage;
                    }

                    // All of the information is valid.  Create a new account
                    if ($ErrorMessage == ""){
                        mysql_select_db("Users", $db);
                        
                        // Confirm Role
                        if ($rolePassword == "admin10176"){$rolePassword = "Administrator";}
                        else if ($rolePassword == "operator") {$rolePassword = "Operator";}
                        else {$rolePassword = "New";}

                        // Check to see if the user exists
                        $userLower = strtolower($user);
                        $sql = "SELECT * FROM userprofile WHERE LoginId = '$userLower'";
                        $result = tableQuery($sql, "LoginId", $userLower, $db);

                        if ($result == 0){
                            $sql = "INSERT INTO userprofile (LoginId, Name, CardId, Password, Role) VALUES ('$userLower', '$cardIDName', '$cardID', '$password', '$rolePassword')";
                            if(mysql_query($sql, $db)){

                                // Set up the user's session
                                $_SESSION['user'] = $userLower;
                                $_SESSION['role'] = $rolePassword;
                                $_SESSION['name'] = $cardIDName;

                                // Create the Pokemon Card Table for the other website
                                $sql = "CREATE TABLE ".$userLower." (name varchar(50), ID varchar(50), natDex varchar(50), count varchar(50), type varchar(50), addTime datetime)";
                                mysql_select_db("PokemonCards", $db);
                                mysql_query($sql,$db);

                                mysql_close($db);

                                // Move to the next website
                                $website = "Location: SuccessfulCreation.php";
                                redirection($website);
                            }
                            else{
                                echo '<h1>Failed</h1>';
                            }
                        }
                        else {echo '<h1>Username already exists </h1>';}
                    } 
                    
                }
            ?>
                
            <form class="form-horizontal" method="post" action="">
                <fieldset><legend>Registration Form</legend></fieldset><br>
                <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls">
                        <input type="text" id="user" name="user" required />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <input type="password" id="password" name="password" required/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="controls">
                        <input type="password" id="confirmPassword" name="confirmPassword" required/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">TECH EXPRESS ID Name</label>
                    <div class="controls">
                        <input type="text" id="idName" name="idName" placeholder="Jesse T Kolean" required />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">TECH EXPRESS ID # </label>
                    <div class="controls">
                        <input type="number" id="cardID" name="cardID" placeholder="5643620171045090" maxlength="16"/>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label">Role Password</label>
                    <div class="controls">
                        <input type="password" id="rolePassword" name="rolePassword" placeholder="Can Leave This Blank" />
                    </div>
                </div>
                <button name="submit" value="Submit" class="btn-block btn-primary btn-large">Submit</button>
            </form>
        </div>
        </div>
    </body>
</html>
