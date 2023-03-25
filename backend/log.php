<?php
/*
    Outputs input to browser console. Will work with 
    nearly whatever you want thanks to JSON encoding
    Usage: console_log(Thing to print in log)

    Citation: https://stackify.com/how-to-log-to-console-in-php/
*/
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
