<?php
include_once 'database.php';

header('Content-Type: application/json');
if (isset($_GET["id"])) {
    $data_hobi = mysqli_query($koneksi, 'SELECT * FROM nama WHERE id = ' . $_GET["id"]);

    $data  = mysqli_fetch_array($data_hobi, MYSQLI_ASSOC);

    echo json_encode($data);
} else {
    $data_hobi = mysqli_query($koneksi, 'SELECT n.id as id, n.name as name, h.name as hobby, k.name as category from nama n, hobi h, kategori k where n.id_hobby=h.id and n.id_category=k.id
    ');

    $data  = mysqli_fetch_all($data_hobi, MYSQLI_ASSOC);

    echo json_encode($data);
}
