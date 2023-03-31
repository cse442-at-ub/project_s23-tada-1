<?php

/*
    head($title)
    Fills in head information on page

    For more information on what goes in the head section, see the following link
    https://developer.mozilla.org/en-US/docs/Learn/HTML/Introduction_to_HTML/The_head_metadata_in_HTML
*/

function head($title)
{
    echo '
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>$title</title>
    <link rel="stylesheet" href="./css/tada.css">
    ';
}
