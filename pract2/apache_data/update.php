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
    $mysqli->query(sprintf("UPDATE students SET name = '%s', surname = '%s' WHERE id = %d;",
        $_POST['name'],
        $_POST['surname'],
        $_POST['id']));
}
?>
<h1>Обновление студента</h1>
<form action="update.php" method="post">
    <label for="id">Id студента: </label>
    <input type="number" name="id" id="id">
    <label for="name">Имя студента: </label>
    <input type="text" name="name" id="name">
    <label for="surname">Фамилия студента: </label>
    <input type="text" name="surname" id="surname">
    <button type="submit">Обновить</button>
</form>
</body>
</html>