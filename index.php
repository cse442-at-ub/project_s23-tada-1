<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TA Developers Asc., Ind Inc LLC</title>
</head>
<body>
<h1>TA Developers Asc., Ind Inc LLC</h1>
<p>Hello World!</p>
<form method="GET" action="register.php">
  <button type="submit">Register</button>
</form>

<form method="GET" action="login.php">
  <button type="submit">Login</button>
</form>

<?php
        $conn = mysqli_connect("oceanus.cse.buffalo.edu:3306", "khlam", "50338576", "cse442_2023_spring_team_p_db");    // Thank you for sacrificing your user info, Kelly
        if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
	else {
		echo "Database Connected";
	}
	$result = mysqli_query($conn, "SELECT * FROM test");
        echo "<table border='1'>
                <tr>
                <th>Id</th>
		<th>Name</th>
                </tr>";
        while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
		echo "<td>" . $row["name"] . "</td>";
		echo "</tr>";
        }
        echo "</table>";
	mysqli_close($conn);
        // Sebastian: Testing that I have edit access
?>
</body>
</html>

