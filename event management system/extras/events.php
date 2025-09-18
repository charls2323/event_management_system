//CREATE
<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $desc = $_POST["description"];
    $date = $_POST["event_date"];

    $sql = "INSERT INTO events (name, description, event_date) VALUES ('$name', '$desc', '$date')";
    mysqli_query($db_connection, $sql);
    echo "Event created!";
    mysqli_close($db_connection);
}
?>

<form method="post">
    <h2>Create Event</h2>
    Name:<br><input type="text" name="name"><br>
    Description:<br><input type="text" name="description"><br>
    Date:<br><input type="date" name="event_date"><br>
    <input type="submit" value="Create">
</form>


//READ
<?php
include("database.php");

$sql = "SELECT * FROM events";
$result = mysqli_query($db_connection, $sql);

echo "<h2>All Events</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: {$row['id']}<br>";
    echo "Name: {$row['name']}<br>";
    echo "Description: {$row['description']}<br>";
    echo "Date: {$row['event_date']}<hr>";
}

mysqli_close($db_connection);
?>

//UPDATE
<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $desc = $_POST["description"];
    $date = $_POST["event_date"];

    $sql = "UPDATE events SET name='$name', description='$desc', event_date='$date' WHERE id=$id";
    mysqli_query($db_connection, $sql);
    echo "Event updated!";
    mysqli_close($db_connection);
}
?>

<form method="post">
    <h2>Update Event</h2>
    Event ID:<br><input type="number" name="id"><br>
    New Name:<br><input type="text" name="name"><br>
    New Description:<br><input type="text" name="description"><br>
    New Date:<br><input type="date" name="event_date"><br>
    <input type="submit" value="Update">
</form>

//DELETE
<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sql = "DELETE FROM events WHERE id=$id";
    mysqli_query($db_connection, $sql);
    echo "Event deleted!";
    mysqli_close($db_connection);
}
?>

<form method="post">
    <h2>Delete Event</h2>
    Event ID:<br><input type="number" name="id"><br>
    <input type="submit" value="Delete">
</form>


