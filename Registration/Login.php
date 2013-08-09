<?php
    include '../Layout.php';
	include '../databaseConnection.php';

    $db = mysql_connect($connection,$dbUsername,$dbPassword);
    if (!$db){die('Could not connect to database');}
    mysql_select_db("Users", $db);

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
           <div style="margin-top:  100px; width: 300px;" class="container"> 
               
            <div class="well well-large"> 
            <?php
                $user;
                $password;

                if(isset($_POST['submit'])){
                    $user = $_POST['username'];
                    $user = verify($user);
                    $password = $_POST['password'];
                    $password = verify($password);

                    $userLower = strtolower($user);

                    $sql = "SELECT * FROM userprofile WHERE LoginId = '$userLower'";
                    $role = attemptLogin($sql, $password, $db);
                    $realName = getName($sql, $db);

                    if ($role != "0"){
                        $_SESSION['user'] = $userLower;
                        $_SESSION['role'] = $role;
                        $_SESSION['name'] = $realName;
                        redirection("Location: SuccessfulLogin.php");
                    }else{
                        echo '<h1>Failed to login.</h1> <p style ="color: #f00"><b> Please check your username and password </b><br><br></p>';
                    }
                }
            ?>
          
              
            <form method="post" action="" autocomplete="off">
            <fieldset>
                    <legend>Log In to Your Account</legend> 
                    <br>  
                            <label>Username</label>
                            <input type="text" id="username" name="username" required/>
                            
                            <br><br>

                            <label>Password</label>
                            <input type="password" id="password" name="password" required/>
                           
                            <br><br>

                            <button type="submit" name="submit" value="Login" class="btn btn-large">Sign In</button></button>
                </fieldset>
            </form> 
            </div>   
        </div>
    </body>
</html>
