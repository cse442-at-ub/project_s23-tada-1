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
function array_sort($array, $on, $order = SORT_ASC)
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

function listDisplayEvents($username, $selectedClass, $selectedType)
{
    require('./backend/connection.php');
    require('./backend/log.php');

    // list of all the events happening on the specific day
    $Monday = array();
    $Tuesday = array();
    $Wednesday = array();
    $Thursday = array();
    $Friday = array();

    // returning list of lists
    $list_return = array();
    $statement = $conn->prepare("SELECT * FROM Events WHERE Username = (?)");

    $statement->bind_param('s', $username);
    $statement->execute();
    $result_query = $statement->get_result();

    $classes = array();
    $types = array();

    if (mysqli_num_rows($result_query) <= 0) {
        return;
    } else {
        // Goes through all events and figures out all of the different classes and types
        // This is to fill out the filter dropdowns
        // I did this in a separate step before the actual list building because if we made the database call with the filtered out events, 
        // then counting up the classes and types wouldn't be accurate to what was in the database
        while ($row = mysqli_fetch_assoc($result_query)) {
            if (!in_array($row['Class'], $classes)) {
                array_push($classes, $row['Class']);
            }
            if (!in_array($row['Event Type'], $types)) {
                array_push($types, $row['Event Type']);
            }
        }

        $selected = array("Class" => $selectedClass, "Event Type" => $selectedType);    // Put selections into array
        $filtered = array_diff($selected, array("None"));                               // Filter out Nones

        $query = "SELECT * FROM Events WHERE `Username` = (?)";     // Base query
        foreach ($filtered as $col => $val) {
            $query .= " AND `" . $col . "` = (?)";                  // Add filter onto query
        }
        $params = [$username];                                                  // Initialize array to bind parameters to
        $params = array_merge($params, array_values($filtered));                // Add filters into parameters to bind
        $statement = $conn->prepare($query);                                    // Prepare statement
        $statement->bind_param(str_repeat('s', count($params)), ...$params);    // Add the right number of s and unpack the parameters into the function
        $statement->execute();
        $result_query = $statement->get_result();

        while ($row = mysqli_fetch_assoc($result_query)) {
            $spaceRemove = trim($row['Day']);
            if ($spaceRemove == 'Monday') {
                $Event = array(
                    0 => $row['Time'],
                    1 => $row['Event Type'],
                    2 => $row['Class'],
                    3 => $row['Description']
                );
                array_push($Monday, $Event);
            }
            if ($spaceRemove == 'Tuesday') {
                $Event = array(
                    0 => $row['Time'],
                    1 => $row['Event Type'],
                    2 => $row['Class'],
                    3 => $row['Description']
                );
                array_push($Tuesday, $Event);
            }
            if ($spaceRemove == 'Wednesday') {
                $Event = array(
                    0 => $row['Time'],
                    1 => $row['Event Type'],
                    2 => $row['Class'],
                    3 => $row['Description']
                );
                array_push($Wednesday, $Event);
            }
            if ($spaceRemove == 'Thursday') {
                $Event = array(
                    0 => $row['Time'],
                    1 => $row['Event Type'],
                    2 => $row['Class'],
                    3 => $row['Description']
                );
                array_push($Thursday, $Event);
            }
            if ($spaceRemove == 'Friday') {
                $Event = array(
                    0 => $row['Time'],
                    1 => $row['Event Type'],
                    2 => $row['Class'],
                    3 => $row['Description']
                );
                array_push($Friday, $Event);
            }
        }
        // sort each day list by the time 
        $sortMon = array_sort($Monday, 0, SORT_ASC);
        $sortTue = array_sort($Tuesday, 0, SORT_ASC);
        $sortWed = array_sort($Wednesday, 0, SORT_ASC);
        $sortThu = array_sort($Thursday, 0, SORT_ASC);
        $sortFri = array_sort($Friday, 0, SORT_ASC);

        // add the sorted lists to the returned value
        array_push($list_return, $sortMon);
        array_push($list_return, $sortTue);
        array_push($list_return, $sortWed);
        array_push($list_return, $sortThu);
        array_push($list_return, $sortFri);
        return array($list_return, $classes, $types);
    }
}


function showFilters($classes, $types)
{
    $classOptions = "";
    $typeOptions = "";

    foreach ($classes as $class) {
        $classOptions .= '<option value="' . $class . '">' . $class . '</option>';
    }
    $classOptions .= '<option value="None">None</option>';

    foreach ($types as $type) {
        $typeOptions .= '<option value="' . $type . '">' . $type . '</option>';
    }
    $typeOptions .= '<option value="None">None</option>';


    $html = <<<"EOT"
        <div id="filter-container">
            <form method="POST" action="mySchedule.php">
                <label for="Class">Class: </label>
                <select name="Class" id="class-select">
                    $classOptions
                </select>
                <label for="Type">Type: </label>
                <select name="Type" id="type-select">
                    $typeOptions
                </select>
                <input type="submit" class="base-button red-button filter-button" name="Filter" value="Filter">
            </form>
        </div>
    EOT;
    echo $html;
}
