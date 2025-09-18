<?php include("database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include("navbar1.php"); ?>

<div class="container">
  <div class="card mx-auto mt-5" style="max-width: 400px;">
    <div class="card-body">
      <h4 class="card-title text-center">Register</h4>
      <form method="post">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control">
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <input type="submit" value="Register" class="btn btn-success w-100">
      </form>
    </div>
  </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = $_POST["password"];

  if (empty($username) || empty($password)) {
    echo "<div class='alert alert-warning text-center mt-3'>Please fill in all fields.</div>";
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";

    try {
      mysqli_query($db_connection, $sql);
      echo "<div class='alert alert-success text-center mt-3'>You are now registered!</div>";
    } catch (mysqli_sql_exception) {
      echo "<div class='alert alert-danger text-center mt-3'>That username is taken.</div>";
    }
  }

  mysqli_close($db_connection);
}
?>
</body>
</html>
