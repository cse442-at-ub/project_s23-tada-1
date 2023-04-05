<?php
require('./backend/session.php');
require('./backend/log.php');
require('./backend/user.php');
startSession();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET) && isset($_SESSION['events'])) {
        $result;
        parse_str(clean_data($_SERVER['QUERY_STRING']), $result);
        echo json_encode($_SESSION['events'][$result["id"]]);
    }
}
