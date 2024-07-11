<?php

include 'authenticate.php';

//session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/signin.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <title>Masuk</title>
</head>
<body class="text-center">

  <div class="container">
    <form action="authenticate.php" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Masuk</p>
        <div class="input-group">
          <input type="text" placeholder="Username" id="inputEmail" name="username" required>
        </div>
        <div class="input-group">
          <input type="password" placeholder="Password" id="inputPassword" name="password" required>
        </div>
        <?php if (isset($_GET['notify'])) {
            if($_GET['notify'] == 'error') {
              echo '<p>Username atau password salah</p>';
            }
        } ?>
        <div class="input-group">
          <button name="do-login" class="btn">Masuk</button>
        </div>
        <p class="login-register-text">Tidak Punya Akun? <a href="register.php">Buat Akun</a>.</p>
    </form>
  </div>
</body>
</html>