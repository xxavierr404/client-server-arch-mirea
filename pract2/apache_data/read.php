<html lang="en">
<head>
    <title>CRUD example</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<?php
include 'links.php';
?>
<h1>Получение студента по ID</h1>
<form action="read.php" method="post">
    <label for="id">Id студента: </label>
    <input type="number" name="id" id="id">
    <button type="submit">Получить</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("db", "user", "userpass111", "appDB");
    $result = $mysqli->query(sprintf("SELECT * FROM students WHERE id = %d;", $_POST['id']));
    if (mysqli_num_rows($result) !== 0) {
        echo '<p>Был найден следующий студент: </p>';
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo sprintf('<p>%s %s</p>', $row['name'], $row['surname']);
    } else {
        echo '<p>Студентов с таким идентификатором не было найдено.</p>';
    }
}
?>
</body>
</html>