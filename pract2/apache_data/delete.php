<html lang="en">
<head>
    <title>CRUD example</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<?php
include 'links.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("db", "user", "userpass111", "appDB");
    $result = $mysqli->query(sprintf("DELETE FROM students WHERE id = %d;", $_POST['id']));
}
?>
<h1>Удаление студента по ID</h1>
<form action="delete.php" method="post">
    <label for="id">Id студента: </label>
    <input type="number" name="id" id="id">
    <button type="submit">Удалить</button>
</form>
</body>
</html>