<?php
    include '../Layout.php';
    if ($_SESSION['role'] != "Administrator" && $_SESSION['role'] != "SuperAdministrator"){
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
                    <h1>Administrator Controls</h1>
                </div>

                <p class="lead">What would you like to do Mr. Administrator?</p>
                
				<div class="dropdown">
					<a class="btn dropdown-toggle btn-primary btn-large" data-toggle="dropdown" href="#">
						Site Management
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="addAnnouncement.php">Add an Announcement</a></li>
						<li><a href="selectUser.php">Promote Users</a></li>
					</ul>
				</div>

				<br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-info btn-large" data-toggle="dropdown" href="#">
						Hockey Management
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="addGame.php">Add a New Hockey Game</a></li>
						<li><a href="extract.php">Extract a Hockey Game List</a></li>
					</ul>
				</div>

				<br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-inverse btn-large" data-toggle="dropdown" href="#">
						Administration Tools
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						
					</ul>
				</div>
               
                <br>
            </div>
        </div>
        <div class="background"></div>
    </body>
</html>

<script>

	/*  
	Function displays the correct confirm bracket and relocater for the given button
	*/
	function verify(location)
	{
		
	}

	$('.dropdown-toggle').dropdown();
</script>