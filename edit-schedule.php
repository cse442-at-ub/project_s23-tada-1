<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Schedule</title>

  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    td:nth-child(even),
    th:nth-child(even) {
      background-color: #ffcccc;
    }
  </style>
</head>

<body>
  <?php
  /*
        Starts a session
        Starting a session stores a key on the users browser that persists until the browser is closed.
        Session variables can then be set on the server associated with the users session and can be accessed across all pages, or multiple PHP files.
        Very convenient system.
    */
  session_start();
  ?>
  <h1>Edit Schedule</h1>

  <h4>Select Schedule</h4>
  <select name="select-schedule" id="select-schedule">
    <option value="select-default">Schedule</option>
    <option value="main-schedule">Main Schedule</option>
  </select>

  <h4>Select Action</h4>
  <select name="select-action" id="select-action">
    <option value="select-default">Action</option>
    <option value="add-event">Add event</option>
    <option value="edit-event">Edit event</option>
    <option value="remove-event">Remove event</option>
  </select>

  <table>
    <tr>
      <th>My events</th>
    </tr>

    <tr>
      <td>
        <p><b>CSE 115 Recitation</b></p>
        <p>Monday 9am</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 115 Recitation</b></p>
        <p>Monday 10am</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 312 Class</b></p>
        <p>Monday 3pm</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 220 Lab</b></p>
        <p>Tuesday 1pm</p>
      </td>
    </tr>

    <tr>
      <td>
        <p><b>CSE 115 Recitation</b></p>
        <p>Wednesday 9am</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 115 Recitation</b></p>
        <p>Wednesday 10am</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 312 Class</b></p>
        <p>Wednesday 3pm</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 220 Lab</b></p>
        <p>Thursday 1pm</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 115 Recitation</b></p>
        <p>Friday 9am</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 115 Recitation</b></p>
        <p>Friday 10am</p>
      </td>
    </tr>
    <tr>
      <td>
        <p><b>CSE 312 Class</b></p>
        <p>Friday 3pm</p>
      </td>
    </tr>
  </table>

  <a href="/mySchedule"><button type="button">Save Changes</button></a>
</body>

</html>
