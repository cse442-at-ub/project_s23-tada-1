<?php

/*
	Starts a session
	Starting a session stores a key on the users browser that persists until the browser is closed.
	Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.

    Will return the username if the user is logged in. If not, it will return the empty string.
    This function should be used on nearly every single page and can be often found alongside isLoggedIn()
*/
function startSession()
{
    session_start();

    $username = "";
    if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
        $username = $_SESSION["username"];
    }

    return $username;
}
