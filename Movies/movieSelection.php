<?php
	include '../Layout.php';
    if ($_SESSION['role'] != "SuperAdministrator"){
        header("Location: ../mainPage.php");
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
                    <h1>Select a Movie to Watch</h1>
                </div>
				
				<?php include 'populateMovies.php'?>
			</div>
		</div>
    </body>
</html>
