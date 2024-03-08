<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <form method="POST">
    username:
    <input placeholder="username" type="text" name="username1">
    email:
    <input placeholder="email" type="text" name="email1">
    password:
    <input id="pass" placeholder="password" type="password" name="password1">
    <br>
    username:
    <input placeholder="username" type="text" name="username2">
    email:
    <input placeholder="email" type="text" name="email2">
    password:
    <input id="pass" placeholder="password" type="password" name="password2">
    <br><br>
    <input type="submit">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = "mydata";
    $table = "users";
    $host = "localhost";
    $usrname = "root";
    $passcode = "";

    if (filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL) && filter_var($_POST["email2"], FILTER_VALIDATE_EMAIL)) {

      try {
        $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $connect->prepare("INSERT INTO $table (username, email, password)
        VALUES (:username1,:email1,:password1)");

        $statement->bindParam(":username1", $username);
        $statement->bindParam(":email1", $email);
        $statement->bindParam(":password1", $password);


        $username = $_POST["username1"];
        $password = $_POST["password1"];
        $email = $_POST["email1"];
        $statement->execute();


        $username = $_POST["username2"];
        $password = $_POST["password2"];
        $email = $_POST["email2"];
        $statement->execute();



        echo "insertion successful!";
      } catch (Exception $e) {
        echo "insertion failed!: " . $e->getMessage();
      }
    } else {
      echo "please enter a valid email";
    }
  }
  ?>

  <script>
  </script>
</body>

</html>