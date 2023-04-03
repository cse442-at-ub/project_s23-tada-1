<?php
// Contains functions for handling users

/*
    insert_user
    Inserts a user into the database
*/
function insert_user($name, $email, $password)
{
    require('connection.php');
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    // Inserts it into the database. If it couldn't for some reason, it'll print out an error message
    $statement = $conn->prepare("INSERT INTO UserData (Username, Email, Password) VALUES (?, ?, ?)");
    $statement->bind_param('sss', $name, $email, $hashed_password);
    $statement->execute();
    if (mysqli_error($conn)) {
        console_log("Error: " . mysqli_error($conn));
    } else {
        console_log("Successfully registered $name to database");
    }

    // Closes the connection
    mysqli_close($conn);
}

/*
    test_password
    Tests if password meets all required characteristics
*/
function test_password($password)
{
    //Checks if there is any uppercase, lowercase, numbers, and special characters
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    // If it doesn't have at every one of them, return error message
    if ($uppercase == 0 || $lowercase == 0 || $number == 0 || $specialChars == 0 || strlen($password) < 8) {
        return false;
    }
    return true;
}

// Cleans input of html injections
function clean_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
