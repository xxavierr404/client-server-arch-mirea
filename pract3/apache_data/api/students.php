<?php
global $conn;
require_once 'common.php';

function getStudents() {
    global $conn;
    $result = $conn->query("SELECT students.id, students.name, students.surname, learn_groups.name as `group` FROM students JOIN learn_groups ON learn_groups.id = group_id");
    $students = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }

    return $students;
}

function getStudentById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT students.id, students.name, students.surname, learn_groups.name as `group` " .
                                    "FROM students JOIN learn_groups ON learn_groups.id = group_id WHERE students.id=?");
    $stmt->bind_param("i", $id);
    $res_status = $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();

    set_status($res_status, 200, 404);

    return $student;
}

function createStudent($name, $surname, $group_id) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO students (name, surname, group_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $surname, $group_id);
    $res_status = $stmt->execute();
    $stmt->close();

    set_status($res_status, 201, 400);
}

function updateStudent($id, $name, $surname, $group_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE students SET name=?, surname=?, group_id=? WHERE id=?");
    $stmt->bind_param("ssii", $name, $surname, $group_id, $id);
    $res_status = $stmt->execute();
    $stmt->close();

    set_status($res_status, 200, 400);
}

function deleteStudent($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param("i", $id);
    $res_status = $stmt->execute();
    $stmt->close();

    set_status($res_status, 200, 404);
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $data = getStudentById((int)$_GET['id']);
        } else {
            $data = getStudents();
        }
        break;
    case 'POST':
        createStudent($_POST['name'], $_POST['surname'], (int)$_POST['group_id']);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents("php://input"), true);

        $id = $_PUT['id'];
        $name = $_PUT['name'];
        $surname = $_PUT['surname'];
        $group_id = $_PUT['group_id'];

        updateStudent($id, $name, $surname, $group_id);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents("php://input"), true);

        deleteStudent((int)$_DELETE['id']);
        break;
}

header('Content-Type: application/json');
if ($data !== null) {
    echo json_encode($data);
}

$conn->close();