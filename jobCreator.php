<?php

require('backend/log.php');
require('backend/session.php');
require("backend/user.php");
$username = startSession();
isLoggedIn($username, "index.php");
// If user type isn't professor
    // redirect to home page
