<?php
$dbc = new PDO('mysql:host=localhost;dbname=sec', 'root', 'root');
$stmt = $dbc->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam('username', $username);
$username = 'Unknown';
$stmt->execute() or die('Error select after PDQ');
while ($row = $stmt->fetch()) {
    echo $row['userid'] . ' ' . $row['username'] . '<br>';
}
$stmt = $dbc->prepare("INSERT INTO users VALUES (?, ?, ?)");
$stmt->bindParam(1, $userid);
$stmt->bindParam(2, $username);
$stmt->bindParam(3, $password);
$userid = 0;
$username = 'Unknown';
$password = '123';
$stmt->execute() or die ('Error insert after PDO');
$stmt = $dbc->prepare("INSERT INTO users VALUES (:userid, :username, :password)");
$stmt->bindParam(':userid', $userid);
$stmt->bindParam(':username', $username);
$stmt->bindParam('password', $password);
$userid = 0;
$username = 'Named placeholder';
$password = '123';
$stmt = null;
$dbc = null;
exit();
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
    <span><?php echo $userid . " " . $username . " " . $password?></span>
</body>
</html>
