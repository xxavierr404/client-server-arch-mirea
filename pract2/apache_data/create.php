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
    $mysqli->query(sprintf("INSERT INTO students (name, surname) VALUES ('%s', '%s')", $_POST['name'], $_POST['surname']));
}
?>
<h1>Создать запись в БД</h1>
<form action="create.php" method="post">
    <label for="name">Имя студента: </label>
    <input type="text" name="name" id="name">
    <label for="surname">Фамилия студента: </label>
    <input type="text" name="surname" id="surname">
    <button type="submit">Добавить</button>
</form>
</body>
</html>