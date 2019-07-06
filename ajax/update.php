<?php
include_once 'database.php';

header('Content-Type: application/json');
$id = $_POST["id"];
$name = $_POST["name"];
$id_hobby = $_POST["hobby"];
$id_category = $_POST["category"];

$update_db = mysqli_query($koneksi, 'UPDATE nama SET name = "' . $name . '", "' . $id_hobby . '" , id_category = "' . $id_category . '" WHERE id = ' . $id);

if ($update_db) {
    $response["success"] = true;
    $response["message"] = "Berhasil mengedit data";
    $response["data"]["id"] = $id;
    $response["data"]["name"] = $name;
    $response["data"]["id_hobby"] = $id_hobby;
    $response["data"]["id_category"] = $id_category;


    echo json_encode($response);
} else {
    $response["success"] = false;
    $response["message"] = "Gagal mengedit data";

    echo json_encode($response);
}
