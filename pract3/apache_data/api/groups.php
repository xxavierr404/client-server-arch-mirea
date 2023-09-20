<?php
global $conn;
require_once 'common.php';

function getLearnGroups() {
    global $conn;
    $result = $conn->query("SELECT * FROM learn_groups");
    $groups = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $groups[] = $row;
        }
    }

    return $groups;
}

function getLearnGroupById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM learn_groups WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $group = $result->fetch_assoc();
    $stmt->close();

    return $group;
}

function createLearnGroup($name) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO learn_groups (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $res_status = $stmt->execute();
    $stmt->close();

    set_status($res_status, 201, 400);
}

function updateLearnGroup($id, $name) {
    global $conn;
    $stmt = $conn->prepare("UPDATE learn_groups SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);
    $res_status = $stmt->execute();
    $stmt->close();

    set_status($res_status, 200, 400);
}

function deleteLearnGroup($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM learn_groups WHERE id=?");
    $stmt->bind_param("i", $id);
    $res_status = $stmt->execute();
    $stmt->close();

    set_status($res_status, 200, 404);
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $data = getLearnGroupById($_GET['id']);
        } else {
            $data = getLearnGroups();
        }
        break;
    case 'POST':
        createLearnGroup($_POST['name']);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents("php://input"), true);

        updateLearnGroup($_PUT['id'], $_PUT['name']);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents("php://input"), true);

        deleteLearnGroup((int) $_DELETE['id']);
        break;
}

header('Content-Type: application/json');
if ($data !== null) {
    echo json_encode($data);
}

$conn->close();