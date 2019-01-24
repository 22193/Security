<?php
// SELECT
//1. Connectie: Demonstration code only
$dbc = new PDO('mysql:host=localhost;dbname=sec', 'root', 'root');
//2. Statement (Named placeholders)
$stmt = $dbc->prepare("SELECT * FROM users WHERE username = :username");
//$stmt = $dbc->prepare("SELECT * FROM users");
// 3. Parameter binding
$stmt->bindParam('username', $username);
// 4. Waarden in variabelen plaatsen
$username = 'Unknown';
// 5. Execute
$stmt->execute() or die('Error select after PDQ');
// 6. WHILE-LOOP
while ($row = $stmt->fetch()) {
    echo $row['userid'] . ' ' . $row['username'] . '<br>';
}
// INSERT
// Prepare (positional placeholder)
$stmt = $dbc->prepare("INSERT INTO users VALUES (?, ?, ?)");
// Bind
$stmt->bindParam(1, $userid);
$stmt->bindParam(2, $username);
$stmt->bindParam(3, $password);
// Waarden
$userid = 0;
$username = 'Unknown';
$password = '123';
//$stmt->execute() or die ('Error insert after PDO');
$stmt->execute();
// Prepare (named placeholder)
$stmt = $dbc->prepare("INSERT INTO users VALUES (:userid, :username, :password)");
// Bind
$stmt->bindParam(':userid', $userid);
$stmt->bindParam(':username', $username);
$stmt->bindParam('password', $password);
// Waarden
$userid = 0;
$username = 'Named placeholder';
$password = '123';
//$stmt->execute() or die ('Error insert after PDO');
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
