<?php

class TypeEvent {
    public $Time;
    public $EventType;
    public $Class;
    public $Description;
}

#----------This function is to help displaying the data we want onto the mySchedule.php page.----------------------------------------#
#----------It'll return a list of lists (where Index 1 = Monday, Index 2 = Tuesday, etc.---------------------------------------------#
#----------Note: You must access this structure/class because you'll need to be able to read this on the mySchedule page later.------#

function listDisplayEvents($username)
{
    include('./backend/connection.php');
    # list of all the events happening on the specific day
    $Monday = array();
    $Tuesday = array();
    $Wednesday = array();
    $Thursday = array();
    $Friday = array();

    # returning list of lists
    $list_return = array();
    $statement = $conn->prepare("SELECT * FROM EventData where Username = (?)");
    if (!$statement) {
        console_log("Error on retrieving data: " . $statement->error);
        return;
    }
    $statement->bind_param('s', $username);
    $statement->execute();
    $result_query = $statement->get_result();

    if (mysqli_num_rows($result_query) <= 0) {
        echo '<tr class="event-row"<td><p>You have no events!</p></td></tr>';
        return;
    }
    else{
        // Supposedly adds a dictionary to a list that will be used to output the values on the schedule page
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['Day'] == 'Monday'){
                $Event = new typeEvent();
                $Event ->$Time = $row['Time'];
                $Event -> $EventType = $row['Event Type'];
                $Event -> $Class = $row['Class'];
                $Event -> $Description = $row['Description'];
                array_push($Monday, $Event);
            }
            if ($row['Day'] == 'Tuesday'){
                $Event = new typeEvent();
                $Event ->$Time = $row['Time'];
                $Event -> $EventType = $row['Event Type'];
                $Event -> $Class = $row['Class'];
                $Event -> $Description = $row['Description'];
                array_push($Tuesday, $Event);
            }
            if ($row['Day'] == 'Wednesday'){
                $Event = new typeEvent();
                $Event ->$Time = $row['Time'];
                $Event -> $EventType = $row['Event Type'];
                $Event -> $Class = $row['Class'];
                $Event -> $Description = $row['Description'];
                array_push($Wednesday, $Event);
            }
            if ($row['Day'] == 'Thursday'){
                $Event = new typeEvent();
                $Event ->$Time = $row['Time'];
                $Event -> $EventType = $row['Event Type'];
                $Event -> $Class = $row['Class'];
                $Event -> $Description = $row['Description'];
                array_push($Thursday, $Event);
            }
            if ($row['Day'] == 'Friday'){
                $Event = new typeEvent();
                $Event ->$Time = $row['Time'];
                $Event -> $EventType = $row['Event Type'];
                $Event -> $Class = $row['Class'];
                $Event -> $Description = $row['Description'];
                array_push($Friday, $Event);
            }
            array_push($list_return, $Monday);
            array_push($list_return, $Tuesday);
            array_push($list_return, $Wednesday);
            array_push($list_return, $Thursday);
            array_push($list_return, $Friday);
        }
        return $list_return;
    }
} 
?>