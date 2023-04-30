<?php
require('../backend/log.php');
require('../backend/session.php');
require('../backend/connection.php');

$username = startSession();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));

    $statement = $conn->prepare("INSERT INTO Jobs (`Title`, `Professor`, `Description`) VALUES (?, ?, ?)");
    $statement->bind_param('sss', $_POST["Title"], $username, $_POST["Description"]);
    $statement->execute();

    echo '<meta http-equiv="refresh" content="0; URL=../jobBoard.php">';
}
