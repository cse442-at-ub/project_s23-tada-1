<?php

function navbar($username)
{
	if ($username == "") {
		$userButtons = <<<"EOT"
						<li>
							<a href="login.php">Login</a>
						</li>
						<li>
							<a href="register.php">Register</a>
						</li>
						EOT;
	} else {
		$userButtons = <<<"EOT"
						<li>
							<a href="backend/logout.php">Log out</a>
						</li>
						EOT;
	}

	$html = <<<"EOT"
		<div class="page-top-view">
			<div class="title-container">
				<ul class="nav">
					<li>
						<h1 class="logo"><a class="unstyled" href="index.php">TADA!</a></h1>
					</li>
				</ul>
			</div>
			<div class="menu-container">
				<ul class="nav">
					<li>
						<a href="profile.php">Profile</a>
					</li>
					<li> 
						<a href="mySchedule.php">My Schedule</a>
					</li>
					<li> 
						<a href="editSchedule.php">Edit Schedule</a>
					</li>
					<li> 
					<a href="jobBoard.php">Job Board</a>
					</li>
					$userButtons
				</ul>
			</div>
		</div>
		EOT;
	echo $html;
}
