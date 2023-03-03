<!DOCTYPE HTML>  
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
        //if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        //    $nameErr = "Only letters and white space allowed";
        //}
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>register here !</h2>
<p><span class="error">* required field</span></p>
<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Username/Email: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Password: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <input type="submit" name="register" value="Register">  
</form>

<?php
    echo "<center><h3>say it back:</h3></center>";
    echo $name;
    echo "<br><br>";
    echo $email;
?>

</body>
</html>