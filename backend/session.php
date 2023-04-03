<?php

function startSession()
{
    session_start();

    $username = "";
    if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
        $username = $_SESSION["username"];
        console_log("User logged in: $username");
    }

    return $username;
}
