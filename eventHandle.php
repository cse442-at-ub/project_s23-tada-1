<?php
require('backend/session.php');
require('backend/log.php');
require('backend/user.php');
$username = startSession();

require('backend/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));
    $event = $_SESSION["currentEvent"];
    $time = $_POST["Time"] . ":00";
    if (isset($_POST['Save_Changes'])) {
        error_log(print_r("Received edit event request", true));
        $statement = $conn->prepare("UPDATE `Events` SET `Day`=?, `Time`=?, `Event Type`=?, `Class`=?, `Description`=? WHERE `Username`=? AND `Day`=? AND `Time`=? AND `Event Type`=? AND `Class`=? AND `Description`=?");
        $statement->bind_param('sssssssssss', $_POST["Day"], $time, $_POST["Type"], $_POST["Class"], $_POST["Description"], $username, $event["Day"], $event["Time"], $event["Event Type"], $event["Class"], $event["Description"]);
    } else if (isset($_POST['Create_Event'])) {
        error_log(print_r("Received new event request", true));
        $statement = $conn->prepare("INSERT INTO `Events` (`Username`, `Day`, `Time`, `Event Type`, `Class`, `Description`) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->bind_param('ssssss', $username, $_POST["Day"], $time, $_POST["Type"], $_POST["Class"], $_POST["Description"]);
    } else if (isset($_POST['Remove_Event'])) {
        error_log(print_r("Received remove event request", true));
        $statement = $conn->prepare("DELETE FROM `Events` WHERE `Username`=? AND `Day`=? AND `Time`=? AND `Event Type`=? AND `Class`=? AND `Description`=?");
        $statement->bind_param('ssssss', $username, $event["Day"], $event["Time"], $event["Event Type"], $event["Class"], $event["Description"]);
    } else {
        echo '<meta http-equiv="refresh" content="0; URL=mySchedule.php">';
    }

    error_log(print_r($event, true));
    $statement->execute();
    echo '<meta http-equiv="refresh" content="0; URL=mySchedule.php">';
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET) && isset($_SESSION['events'])) {
        $result;
        parse_str(clean_data($_SERVER['QUERY_STRING']), $result);
        $event = $_SESSION['events'][$result["id"]];
        $_SESSION['currentEvent'] = $event;
        echo json_encode($event);
    }
}
