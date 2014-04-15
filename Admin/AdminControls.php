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
						<li><a href="removePlayer.php">Remove a Person From a Hockey Game</a></li>
					</ul>
				</div>

				<br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-warning btn-large" data-toggle="dropdown"	href="#">
						Mumble Services
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a onclick="verify(1)">Start the Server</a></li>
						<li><a onclick="verify(2)">Restart the Server</a></li>
						<li><a onclick="verify(3)">Stop the Server</a></li>
					</ul>
				</div>

				<br>

				<div class="dropdown">
					<a class="btn dropdown-toggle btn-inverse btn-large" data-toggle="dropdown" href="#">
						Administration Tools
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="../../PokemonCardSorter/mainPage.php">Change to Pokemon Website</a></li>

						<?php
							// Access to diary
							if ($_SESSION['role'] == "SuperAdministrator"){
								echo '<li><a href="../Diary/Diary.php">Access Diary</a></li>
									  <li><a href="../Movies/movieSelection.php">Watch a Movie</a></li>';
							}
						?>
                		
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
		if (location == 1)
		{
			// 1 - Start the Murmur Server provided it is down
			var r = confirm("Would you like to start Murmur? If the server is already up, it will not restart.");
			if (r == true)
			{
				window.location = "../Mumble/startMurmur.php";
			}
		}else if (location == 2)
		{
			// 2 - Restart the Murmur Server if it is Up
			var r = confirm("Would you like to restart Murmur? Please note you will disconnect all currently connected users.");
			if (r == true)
			{
				window.location = "../Mumble/restartMurmur.php";
			}
		}else if (location == 3)
		{
			// 3 - Delete the Tournament Brackets, Team Listings, and Mumble Server Channels
			var r = confirm("Would you like to shut down Murmur? Please note you will disconnect anyone current connected.");
			if (r == true)
			{
				window.location = "../Mumble/stopMurmur.php";
			}
		}
	}

	$('.dropdown-toggle').dropdown();
</script>