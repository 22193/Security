<?php
// input
$username = "";
$password = "";
$email = "";



// Empty isset
if (!empty($_POST['username']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    echo '<br>' . 'username: ' .$username . '<br>' . 'password: ' . $password . '<br>' . 'email: ' . $email;
}
//Lengte
if(!empty($_POST)) {

    if (strlen($username) < 8) {
        echo('<p>  Usernames need to be 8 characters or longer </p>
<a href="index.php"> click here to return</a>');
    }

    if (strlen($password) < 10) {
        echo('<p> Passwords need to be 10 characters or longer </p>');
    }

    if (strlen($username) > 16) {
        echo('<p> Usernames cant be longer than 16 characters </p>');
    }

    if (strlen($password) > 15) {
        echo('<p> Passwords cant be longer than 15 characters </p>');
    }


// Filter for email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo(" $email is a valid email address");
} else {
    echo(" $email is not a valid email address");
}

// Validation allowed chars
    $error_message = "";
    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$username)) {
        $error_message .=  '<br>' . 'De naam die uw heeft ingevoerd klopt niet.<br />';
    }
    if(strlen($error_message) > 0) {
        die($error_message);
    }
}
//mysqli_real_escape_string Voorbeeld Werkt niet
$db = mysqli_connect("localhost","root","root","DB");

// Check connection with DB
if (mysqli_connect_errno()) {
    echo "Failed to connect to DB " . mysqli_connect_error();
}

// Escape Variables
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$email = mysqli_real_escape_string($db, $_POST['email']);

$sql="INSERT INTO users (username, password, email)
VALUES ('$username', '$password', '$email')";

if (!mysqli_query($db,$sql)) {
    die('Error: ' . mysqli_error($db));
}

//echo "record";

mysqli_close($db);

//Prepare, Execute in opdracht 1 en 3

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post">
    <label for="username">Username</label> <br>
    <input type="text" name="username" required> <br>
    <label for="password">Password</label> <br>
    <input type="password" name="password" required> <br>
    <label for="email">E-mail</label> <br>
    <input type="email" name="email" required> <br>
    <input type="submit" value="submit" name="submit">
</form>
</body>
</html>
