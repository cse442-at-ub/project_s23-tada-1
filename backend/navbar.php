<?php

function navbar($username)
{

	$html = <<<"EOT"
		<div class="page-top-view">
			<div class="title-container">
				<ul class="nav">
					<li>
						<h2 class="logo"><a class="unstyled" href="index.php">TADA!</a></h2>
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
						<a href="jobBoard.php">Job Board</a>
					</li>
					<li> 
						<a href="editSchedule.php">Edit Schedule</a>
					</li>
					<li> 
						<a href="jobCreator.php">Job Creator</a>
					</li>
					<li>
						<a href="/backend/logout.php">Logout</a> 
					</li>

				</ul>
			</div>
		</div>
		EOT;
	echo $html;
}
