<?php
include 'db.php';

error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $parent = intval($_POST['parent']);

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo json_encode(["status" => "error", "message" => "Invalid name format"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO members (name, parentId, createdDate) VALUES (:name, :parent, NOW())");
        $stmt->execute(['name' => $name, 'parent' => $parent]);

        echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>
