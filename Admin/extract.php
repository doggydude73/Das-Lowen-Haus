<?php
    
    include '../Layout.php';
	include '../databaseConnection.php';

    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "SuperAdministrator"){
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
        <div style="margin-top:  50px; width: 400px;" class="container">
            <div class="page-header">
                <h1 style="text-align: center">Attendance List</h1>
            </div>

            <p class="lead" style="text-align: center">Select a Game to Extract</p>

            <form class="form-inline" method="post" autocomplete="off">
                <fieldset>
                      <select style="width: 300px;" name="games" required>
                                <?php
                                    
                                    $query = "SELECT * FROM gameList";
                                    $sql = mysql_query($query, $db);

                                    // For each row in the query
                                    while($row = mysql_fetch_array($sql))
                                    {
                                        // Place all games in a selectable list
                                        $name = $row['opponent'];
                                        $shorty = $row['shortName'];

                                        echo '<option value = '.$shorty.'>'.$name.'</option>';
                                    }
                                ?>

                            </select>
                     
                    <button type="submit" name="submit" value="Submit" class="btn">Submit</button>
                </fieldset>
            </form>
            <br/>
            
            <?php
                /* Report the people selected in the option above */  
                if(isset($_POST['submit'])){
                    echo '<div class="well well-large">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student Name </th>
                                        <th> TECH EXPRESS ID Number</th>
                                    </tr>
                                </thead>
                        <tbody>';

                    $shorty = $_POST['games'];

                    $query = "SELECT * FROM ".$shorty." ORDER BY name";
                    $sql = mysql_query($query,$db);
                    echo "Hockey Game: <strong>".$shorty."</strong><br/><br/>";
                    // For each row in the query
                    while($row = mysql_fetch_array($sql))
                    {
                        if ($row['attendance'] == 1){
                            $person = $row['name']; 
                            $ID = $row['ID'];
                            echo '<tr>';
                            echo "<td>".$person." </td><td>".$ID." </td>";
                            echo '</tr>';
                        }
                    }
                    echo'</tbody></table></div>';
                }
            ?>  
        </div>
    </body>
</html>
