<html lang="en">
<head>
    <title>CRUD example</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<?php
include 'links.php';
?>
<h1>Список всех записей в БД</h1>
<table>
    <tr><th>Id</th><th>Name</th><th>Surname</th></tr>
<?php
$mysqli = new mysqli("db", "root", "mypass333", "appDB");
$result = $mysqli->query("SELECT * FROM students");
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
}
?>
</table>
</body>
</html>