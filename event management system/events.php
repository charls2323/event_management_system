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
    <title>Create Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include("navbar.php"); ?>

<div class="container">
    <div class="card mx-auto mt-5" style="max-width: 500px;">
        <div class="card-body">
            <h4 class="card-title text-center">Create New Event</h4>
            <form method="post">
                <input type="text" name="name" class="form-control mb-2" placeholder="Event Name">
                <input type="text" name="description" class="form-control mb-2" placeholder="Description">
                <input type="date" name="event_date" class="form-control mb-2">
                <input type="submit" name="create" value="Create" class="btn btn-primary w-100">
            </form>
        </div>
    </div>

    <?php
   if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $desc = $_POST["description"];
    $date = $_POST["event_date"];
    $sql = "INSERT INTO events (name, description, event_date, user_id) VALUES ('$name', '$desc', '$date', $user_id)";
    mysqli_query($db_connection, $sql);
    header("Location: index.php");
    exit;
}


    mysqli_close($db_connection);
    ?>
</div>
</body>
</html>
