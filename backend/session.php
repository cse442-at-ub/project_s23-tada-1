<?php

/*
	Starts a session
	Starting a session stores a key on the users browser that persists until the browser is closed.
	Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
	Very convenient system.
*/
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
