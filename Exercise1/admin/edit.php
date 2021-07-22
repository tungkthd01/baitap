<?php
require_once('./db/helperdb.php');
function vn_to_str($str)
{

    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D' => 'Đ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );

    foreach ($unicode as $nonUnicode => $uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ', '_', $str);
    return $str;
}
$title = $description = $image_url = $status = "";
$id = '';
if (isset($_GET['id'])) {
    $id       = $_GET['id'];
    $sql      = 'select * from post where id = ' . $id;
    $category = executeSingleResult($sql);
    if ($category != null) {
        $title = $category['title'];
        $description = $category['description'];
        $image_url = $category['image'];
        $status = $category['status'];
    }
}

if (!empty($_POST)) {
    var_dump($_POST);
    $id = $_POST['id'];
    if (isset($_POST['tit'])) {
        $title = $_POST['tit'];
    }
    if (isset($_POST['descrip'])) {
        $description = $_POST['descrip'];
    }
    if ($_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png" || $_FILES['img']['type'] == "image/jpg") {
        $path = "./image/";
        $tmp_name = $_FILES['img']['tmp_name'];
        $img_name = $_FILES['img']['name'];
        move_uploaded_file($tmp_name, $path . $img_name);
        $image_url = $path . $img_name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu

    }
    $status = $_POST['status'];

    if (!empty($title) && !empty($description) && $id != '') {
        $sql = 'update post set title = "' . $title . '", description ="' . $description . '",image ="' . $image_url . '",status="' . $status . '",updated_at = "' . $updated_at . '" where id = ' . $id;
        echo $sql;
        execute($sql);

        header('Location: http://localhost/Exercise1/admin/manage.html');
        die();
    }
    
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post manage</title>
    <base href="http://localhost/Exercise1/admin/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin: auto;
        }

        ;

        .logintag {
            margin-right: 70px;
            text-align: right;
            position: absolute;
        }
    </style>
</head>

<body>


    <div style="display: flex;justify-content: flex-end;">
        <div class="text-right">
            <?php
            $titlename = vn_to_str($title);
            echo ' <a href="show/' . $titlename . '-' .$id. '.html">
            <button class="btn btn-default send">show</button>
        </a>';
            ?>

        </div>
        <div class="text-right">
            <a href="manage.html">
                <button class="btn btn-default send">back</button>
            </a>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center
            height">
        <div class="card py-3">
            <div class="p-3 d-flex align-items-center
                    justify-content-center">
                <h2>Edit</h2>
            </div>
            <div class="p-3 px-4 py-2">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="font-weight-normal quote col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mb-2" placeholder="title" name="tit" value="<?= $title ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="font-weight-normal quote col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mb-2" placeholder="Description" name="descrip" value="<?= $description ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="font-weight-normal quote col-sm-2 col-form-label">Select image:</label>
                        <div class="col-sm-10">
                            <input onchange="readURL(this);" type="file" id="img" name="img" accept="image/*" src="">
                        </div>
                        <div class="image-area mt-4"><img id="imageResult" src="<?= $image_url ?>" alt="" class="img-fluid rounded shadow-sm mx-auto d-block" width="300" height="300"></div>
                    </div>
                    <script type="text/javascript">
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#imageResult')
                                        .attr('src', e.target.result);
                                };
                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                        $(function() {
                            $('#upload').on('change', function() {
                                readURL(input);
                            });
                        });

                        /*  ==========================================
                            SHOW UPLOADED IMAGE NAME
                        * ========================================== */
                        var input = document.getElementById('img');
                        var infoArea = document.getElementById('upload-label');

                        input.addEventListener('change', showFileName);

                        function showFileName(event) {
                            var input = event.srcElement;
                            var fileName = input.files[0].name;
                            infoArea.textContent = 'File name: ' + fileName;
                        }
                    </script>

                    <input type="text" name="id" hidden="true" value="<?= $id ?>">
                    <div class="form-row align-items-center form-group row">
                        <div class="col-sm-2 col-form-label">
                            <label class="font-weight-normal quote ">Status</label>
                        </div>

                        <div class="col-sm-10">
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
                                <option selected value="1">enable</option>
                                <option value="0">disable</option>
                            </select>
                        </div>


                    </div>
                    <div class="text-center">
                        <button class="btn btn-danger send" type="submit">Submit</button>
                    </div>
                </form>



            </div>
        </div>
    </div>
</body>

</html>