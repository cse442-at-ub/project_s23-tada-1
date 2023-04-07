<?php

// class TypeEvent {
//     public $Time;
//     public $EventType;
//     public $Class;
//     public $Description;
// }

//----------This function is to help displaying the data we want onto the mySchedule.php page.----------------------------------------#
//----------It'll return a list of lists (where Index 1 = Monday, Index 2 = Tuesday, etc.---------------------------------------------#
//----------Note: You must access this structure/class because you'll need to be able to read this on the mySchedule page later.------#

// Helper function to sort array by key //

// Function taken from https://www.php.net/manual/en/function.sort.php //
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function listDisplayEvents($username)
{
    include('./backend/connection.php');
    include('./backend/log.php');

    // list of all the events happening on the specific day
    $Monday = array();
    $Tuesday = array();
    $Wednesday = array();
    $Thursday = array();
    $Friday = array();

    // returning list of lists
    $list_return = array();
    $statement = $conn->prepare("SELECT * FROM Events WHERE Username = (?)");

    if (!$statement) {
        console_log("Error on retrieving data: " . $conn->error);
        // echo mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
        $counter = 0;
        // Supposedly adds a dictionary to a list that will be used to output the values on the schedule page
        while ($row = mysqli_fetch_assoc($result_query)) {
            $spaceRemove = trim($row['Day']);
            if ($spaceRemove == 'Monday'){
                $Event = array(
                    "Time" => $row['Time'], 
                    "EventType" => $row['Event Type'],
                    "Class" => $row['Class'],
                    "Description" => $row['Description']
                );
                $count++;
                array_push($Monday, $Event);
            }
            if ($spaceRemove == 'Tuesday'){
                $Event = array(
                    "Time" => $row['Time'],
                    "EventType" => $row['Event Type'],
                    "Class" => $row['Class'],
                    "Description" => $row['Description']
                );
                array_push($Tuesday, $Event);
            }
            if ($spaceRemove == 'Wednesday'){
                $Event = array(
                    "Time" => $row['Time'],
                    "EventType" => $row['Event Type'],
                    "Class" => $row['Class'],
                    "Description" => $row['Description']
                );
                array_push($Wednesday, $Event);
            }
            if ($spaceRemove == 'Thursday'){
                $Event = array(
                    "Time" => $row['Time'],
                    "EventType" => $row['Event Type'],
                    "Class" => $row['Class'],
                    "Description" => $row['Description']
                );
                array_push($Thursday, $Event);
            }
            if ($spaceRemove == 'Friday'){
                $Event = array(
                    "Time" => $row['Time'],
                    "EventType" => $row['Event Type'],
                    "Class" => $row['Class'],
                    "Description" => $row['Description']
                );
                array_push($Friday, $Event);
            }
        }
        // sort each day list by the time 
        $sortMon = array_sort($Monday, "Time", SORT_ASC);
        $sortTue = array_sort($Tuesday, "Time", SORT_ASC);
        $sortWed = array_sort($Wednesday, "Time", SORT_ASC);
        $sortThu = array_sort($Thursday, "Time", SORT_ASC);
        $sortFri = array_sort($Friday, "Time", SORT_ASC);

        // add the sorted lists to the returned value
        array_push($list_return, $sortMon);
        array_push($list_return, $sortTue);
        array_push($list_return, $sortWed);
        array_push($list_return, $sortThu);
        array_push($list_return, $sortFri);
        return $list_return;
    }
} 
?>