<?php
// If the code is being run locally (for development or testing), alter the root directory
// This way you don't have to worry about the wrong link when testing
if (php_sapi_name() == 'cli-server') {
    $root_dir = '.';
} else {
    $root_dir = '/CSE442-542/2023-Spring/cse-442p/project_s23-tada-1';
}

return (object) array(
    'db_address' => getenv("DB_ADDRESS"),
    'db_username' => getenv("DB_USER"),
    'db_password' => getenv("DB_PASS"),
    'db_name' => getenv("DB_NAME"),
    'root_dir' => $root_dir,
);
