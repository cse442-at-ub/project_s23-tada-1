<?php
$config = require('config.php');

// Eventually I need to figure out how to hide my password and username from users...
// Connect to database, error if couldn't connect
$conn = mysqli_connect($config->db_address, $config->db_username, $config->db_password, $config->db_name);

if (mysqli_connect_errno()) {
    console_log("Database Status: Failed to connect: " . mysqli_connect_error());
}
