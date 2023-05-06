<?php
// If the code is being run locally (for development or testing), alter the root directory
// This way you don't have to worry about the wrong link when testing
if (php_sapi_name() == 'cli-server') {
    $root_dir = '.';
} else {
    $root_dir = '/CSE442-542/2023-Spring/cse-442p/project_s23-tada-1';
}

return (object) array(
    'db_address' => 'oceanus.cse.buffalo.edu:3306',
    'db_username' => 'khlam',   // Thank you for sacrificing your user info, Kelly
    'db_password' => '50338576',
    'db_name' => 'cse442_2023_spring_team_p_db',
    'root_dir' => $root_dir,
);
