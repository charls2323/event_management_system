<?php
session_start();
include("database.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include("navbar.php"); ?>

<div class="container">
    <h3 class="text-center mt-4">Your Events</h3>

    <!-- Edit/Update/Delete Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Edit or Delete Event</h5>
            <form method="post">
                <select name="id" class="form-select mb-2">
                    <option value="">Select Event</option>
                    <?php
                    $result = mysqli_query($db_connection, "SELECT * FROM events WHERE user_id = $user_id");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']} ({$row['event_date']})</option>";
                    }
                    ?>
                </select>
                <input type="text" name="name" class="form-control mb-2" placeholder="New Name">
                <input type="text" name="description" class="form-control mb-2" placeholder="New Description">
                <input type="date" name="event_date" class="form-control mb-2">
                <div class="d-flex gap-2">
                    <input type="submit" name="update" value="Update" class="btn btn-warning w-50">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger w-50">
                </div>
            </form>
        </div>
    </div>

    <!-- Display Events -->
    <div class="row">
        <?php
        $result = mysqli_query($db_connection, "SELECT * FROM events WHERE user_id = $user_id");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='col-md-4 mb-3'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$row['name']}</h5>";
            echo "<p class='card-text'>{$row['description']}</p>";
            echo "<p class='card-text'><small class='text-muted'>Date: {$row['event_date']}</small></p>";
            echo "</div></div></div>";
        }

        // Update
        if (isset($_POST["update"])) {
            $id = $_POST["id"];
            $name = $_POST["name"];
            $desc = $_POST["description"];
            $date = $_POST["event_date"];
            $sql = "UPDATE events SET name='$name', description='$desc', event_date='$date' WHERE id=$id AND user_id=$user_id";
            mysqli_query($db_connection, $sql);
            header("Location: index.php");
            exit;
        }


        // Delete
        if (isset($_POST["delete"])) {
            $id = $_POST["id"];
            $sql = "DELETE FROM events WHERE id=$id AND user_id=$user_id";
            mysqli_query($db_connection, $sql);
            header("Location: index.php");
            exit;
        }


        mysqli_close($db_connection);
        ?>
    </div>
</div>
</body>
</html>
