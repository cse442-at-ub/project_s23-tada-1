<?php
function helper($item, $action)
{
    $statement = "";
    require('./backend/connection.php');
    if ($action == "insert") {
        $statement = $conn->prepare("INSERT INTO Events (Item) VALUES (?)");
        $statement->bind_param('s', $item);
    } else if ($action == "remove") {
        $statement = $conn->prepare("DELETE FROM Events WHERE Item=(?)");
    }

    if ($statement != "") {
        $statement->bind_param('s', $item);
        $statement->execute();
    }
}

function updateHelper($old, $new)
{
    $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");

    $sql_query = "UPDATE ScheduleDatabase (Item) SET ('$new') WHERE (Item) = ('$old')";

    mysqli_query($conn, $sql_query);
    mysqli_close($conn);
}

function displayScheduleTest($username)
{
    require("./backend/connection.php");

    $statement = $conn->prepare("SELECT * FROM Events where Username = (?)");
    if (!$statement) {
        console_log("Error on event display: " . $conn->error);
        return;
    }
    $statement->bind_param('s', $username);
    $statement->execute();
    $result_query = $statement->get_result();

    echo "Schedule: <br>";
    while (($event = mysqli_fetch_assoc($result_query))) {
        echo json_encode($event) . "\n";
    }
}

if (!empty($_GET["insert"])) {
    // echo "insert works";
    helper($_GET["insert"], "insert");
} else if (!empty($_GET["update_current"]) and !empty($_GET["update_new"])) {
    // echo "update works";
    updateHelper($_GET["update_current"], $_GET["update_new"]);
} else if (!empty($_GET["remove"])) {
    // echo "remove works";
    helper($_GET["remove"], "remove");
}

displayScheduleTest($username);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
</head>

<body>

    <form method="GET" action="index.php">
        Insert: <input type="text" name="insert">
        <button type="submit">Insert</button>
    </form>
    <br>
    <form method="GET" action="index.php">
        Current: <input type="text" name="update_current">
        New: <input type="text" name="update_new">
        <button type="submit">Update</button>
    </form>
    <br>
    <form method="GET" action="index.php">
        Remove: <input type="text" name="remove">
        <button type="submit">Remove</button>
    </form>

</body>

</html>
