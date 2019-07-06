<?php
include_once 'database.php';

$name = $_POST["name"];
$id_hobby = $_POST["id_hobby"];
$id_category = $_POST["id_category"];

$insert_db = mysqli_query($koneksi, 'INSERT INTO nama SET name = "' . $name . '", "' . $id_hobby . '", id_category = "' . $id_category . '"');

header('Content-Type: application/json');
if ($insert_db) {
    $response["success"] = true;
    $response["message"] = "Berhasil memasukkan data";
    $response["data"]["name"] = $name;
    $response["data"]["id_category"] = $id_category;
    $response["data"]["id_hobby"] = $id_hobby;

    echo json_encode($response);
} else {
    $response["success"] = false;
    $response["message"] = "Gagal memasukkan data";

    echo json_encode($response);
}
