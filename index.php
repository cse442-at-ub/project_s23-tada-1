<?php
$config = require('backend/config.php');
require('backend/log.php');
require('backend/session.php');
$username = startSession();

require('backend/connection.php');
require('backend/head.php');
require('backend/navbar.php');
require('backend/indexHelper.php');

console_log("Running on " . php_sapi_name());

$appSubmit = "";
if (!empty($_GET["application_name"]) and !empty($_GET["application_experience"]) and !empty($_GET["application_reason"])) {
	$appSubmit =  <<<"EOT"
			<div class="application-submission">
				<h2>Congratulations Application Submitted</h2>
			</div>
			EOT;

	$app_name = htmlspecialchars($_GET["application_name"]);
	$app_experience = htmlspecialchars($_GET["application_experience"]);
	$app_reason = htmlspecialchars($_GET["application_reason"]);
	$app_id = $_GET["getId"];
	settype($app_id, "integer");

	$statement = $conn->prepare("INSERT INTO JobApp (id, Name, Experience, Reason) VALUES (?, ?, ?, ?)");
	$statement->bind_param('isss', $app_id, $app_name, $app_experience, $app_reason);
	$statement->execute();
}

?>

<!DOCTYPE html>
<html>

<head>
	<?php head('TA Developers Asc., Ind Inc LLC'); ?>
</head>

<body>
	<?php navbar($username) ?>
	<?php echo $appSubmit; ?>
	<div class="page-header">
		<h1>Teaching Assistant Developers Association</h1>
		<div class="button-container">
			<?php renderButtons($username); ?>
		</div>
		<div class="welcome-message">
			<?php
			// If user has logged in during the session, display welcome message
			if ($username != "") {
				echo "Hello, $username";
			}
			?>
		</div>
	</div>
</body>

</html>
