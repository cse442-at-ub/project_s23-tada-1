<?php
// Contains functions for handling users

/*
    insert_user
    Inserts a user into the database
*/
function insert_user($name, $username, $email, $password, $aboutMe, $exp1, $exp2)
{
    require('connection.php');
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    // Inserts it into the database. If it couldn't for some reason, it'll print out an error message
    $statement = $conn->prepare("INSERT INTO UserData (Name, Username, Email, Password, AboutMe, Experience1, Experience2) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param('sssssss', $name, $username, $email, $hashed_password, $aboutMe, $exp1, $exp2);
    $statement->execute();
    if (mysqli_error($conn)) {
        console_log("Error: " . mysqli_error($conn));
        return false;
    }

    // Closes the connection
    mysqli_close($conn);
    return true;
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
