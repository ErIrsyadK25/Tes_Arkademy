<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Arkademy Test</title>
</head>

<body>
    <div class="container">
        <center>
            <h2>Arkademy</h2>
            <p>Data Hobi</p>
        </center>
        <div class="col-md-12">
            <div class="col-md-11">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-success" data-toggle="modal" onclick="manage_hobi(0,0)">Tambah</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Hobby</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="data_hobi">

            </tbody>
        </table>
    </div>
    <div class="modal fade" id="manage_hobi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-label">Tambah Hobi</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="col-md-12" id="data_hobi">
                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="control-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="control-label">Hobby</label>
                                <select name="hobby" class="form-control" data-error='Please Enter Hobby!' required>
                                    <option selected="selected">Hobbies..</option>
                                    <?php
                                    $sql = "SELECT * FROM hobi";
                                    $query = mysqli_query($koneksi, $sql);
                                    while ($row = mysqli_fetch_object($query)) {
                                        echo "<option value =$row->id_hobby>$row->name</option>";
                                    }
                                    ?>
                                </select>
                                <div class="help-blocks with-errors"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="control-label">Category</label>
                                <select name="category" class="form-control" data-error='Please Enter Category!' required>
                                    <option selected="selected">Categories..</option>
                                    <?php
                                    $sql = "SELECT * FROM kategori";
                                    $query = mysqli_query($koneksi, $sql);
                                    while ($row = mysqli_fetch_object($query)) {
                                        echo "<option value =$row->id_category>$row->name</option>";
                                    }
                                    ?>
                                </select>
                                <div class="help-blocks with-errors"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="data_hobi()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var status_manage_hobi;
        var id_hobi;

        function init() {
            $('tbody')[0].innerHTML = "";
            $.ajax({
                method: "GET",
                url: "get.php",
                success: (response) => {
                    var i;
                    for (i = 0; i < response.length; i++) {
                        $('tbody').append('<tr id="' + response[i].id + '"><td>' + (i + 1) + '</td><td>' + response[i].name + '</td><td>' + response[i].hobby + '</td><td>' + response[i].category + '</td><td><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"onclick="hapus_hobi(' + response[i].id + ')"></span></button> <button type="button" class="btn btn-primary" onclick="manage_hobi(1, ' + response[i].id + ')"><span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></button></td></tr>');
                    }
                }
            });
        }

        init();

        function data_hobi() {
            if (status_manage_hobi == 1) {
                edit_hobi();
            } else {
                tambah_hobi();
            }
        }

        function manage_hobi(type, id) {
            status_manage_hobi = type;
            if (type == 1) {
                $('#modal-label')[0].innerHTML = "Edit Data";
                id_hobi = id;
                get_hobi(id);
            } else {
                $('#modal-label')[0].innerHTML = "Tambah Data";
                $('input[name=name]').val("");
                $('input[name=id_hobby]').val("");
                $('input[name=id_category]').val("");
                $('#manage_hobi').modal('show');
                id_hobi = null;
            }
        }

        function tambah_hobi() {
            $.ajax({
                method: "POST",
                url: "insert.php",
                data: {
                    name: $('input[name=name]').val(),
                    id_hobby: $('input[name=id_hobby]').val(),
                    id_category: $('input[name=id_category]').val()
                },
                success: (response) => {
                    if (response.success) {
                        $('input[name=name]').val("");
                        $('input[name=id_hobby]').val("");
                        $('input[name=id_category]').val("");
                        $('#manage_hobi').modal('hide');
                        init();
                    } else {

                    }
                }
            });
        }

        function edit_hobi() {
            $.ajax({
                method: "POST",
                url: "update.php",
                data: {
                    id: id_hobi,
                    name: $('input[name=name]').val(),
                    id_hobby: $('input[name=id_hobby]').val(),
                    id_category: $('input[name=id_category]').val()
                },
                success: (response) => {
                    if (response.success) {
                        $('input[name=name]').val("");
                        $('input[name=id_hobby]').val("");
                        $('input[name=id_category]').val("");
                        $('#manage_hobi').modal('hide');
                        init();
                    } else {

                    }
                }
            });
        }

        function get_hobi(id) {
            $.ajax({
                method: "GET",
                data: {
                    id: id
                },
                url: "get.php",
                success: (response) => {
                    $('input[name=name]').val(response.name);
                    $('input[name=id_hobby]').val(response.id_hobby);
                    $('input[name=id_category]').val(response.id_category);
                    $('#manage_hobi').modal('show');
                }
            });
        }

        function hapus_hobi(id) {
            $.ajax({
                method: "POST",
                data: {
                    id: id
                },
                url: "delete.php",
                success: (response) => {
                    if (response.success) {
                        init();
                    } else {
                        console.log(response.message);
                    }
                }
            });
        }
    </script>
</body>

</html>