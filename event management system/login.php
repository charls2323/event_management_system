<?php
session_start();
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include("navbar1.php"); ?>
<div class="container">
  <div class="card mx-auto mt-5" style="max-width: 400px;">
    <div class="card-body">
      <h4 class="card-title text-center">Login</h4>
      <form method="post">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control">
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <input type="submit" value="Login" class="btn btn-primary w-100">
      </form>
    </div>
  </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT id, password FROM users WHERE username = '$username'";
  $result = mysqli_query($db_connection, $sql);

  if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row["password"])) {
      $_SESSION["user_id"] = $row["id"];
      header("Location: events.php");
      exit;
    } else {
      echo "<div class='alert alert-danger text-center mt-3'>Invalid password.</div>";
    }
  } else {
    echo "<div class='alert alert-warning text-center mt-3'>Username not found.</div>";
  }

  mysqli_close($db_connection);
}
?>
</body>
</html>
