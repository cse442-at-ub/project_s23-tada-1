<?php
function renderButtons($username)
{
	$html = "";

	if ($username == "") {
		$html = <<<"EOT"
			<form method="GET" action="register.php">
				<button type="submit" class="base-button green-button">Register</button>
			</form>
			<form method="GET" action="login.php">
				<button type="submit" class="base-button green-button">Login</button>
			</form>
			EOT;
	} else {
		$html = <<<"EOT"
			<form method="GET" action="backend/logout.php">
				<button type="submit" class="base-button green-button">Log out</button>
			</form>
			EOT;
	}

	echo $html;
}
