<?php session_start();
error_reporting(0); ?>
<?php

if (!($_SESSION['username'])) {
    header("Location: ./login.html");
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
    <base href="http://localhost/Exercise1/admin/">
    <title>Manage Post</title>
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
    <div>
        <div>

        </div>
        <div class="text-right">
            <a href="logout.php"><button type="button" class="btn btn-default send ">logout</button></a>
        </div>

    </div>
    <div>

        <div>
            <div>
                <h2>Manage</h2>
                <a href="add.html">
                    <button type="button" class="btn btn-default send">new</button>
                </a>

            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID </th>
                        <th>Thumb </th>
                        <th>Title </th>
                        <th>Status </th>
                        <th>Action </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
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
                    require_once('././db/helperdb.php');
                    $sql = 'select count(id) as number from post';
                    $result = executeResult($sql);
                    $number = 0;
                    if ($result != null && count($result) > 0) {
                        $number = $result[0]['number'];
                    }
                    $pages = ceil($number / 5);
                    $current_page = 1;
                    $index = 0;
                    if (isset($_GET['page'])) {
                        $current_page = $_GET['page'];
                    }
                    $index = ($current_page - 1) * 5;
                    $sql = 'select * from post limit ' . $index . ',5';
                    $post = executeResult($sql);
                    $index1 = 1 + ($current_page - 1) * 5;
                    $status = '';
                    foreach ($post as $item) {
                        $titlename = vn_to_str($item['title']);
                        if ($item['status'] == 1) {
                            $status = 'enable';
                        } else
                            $status = 'disable';
                        echo '<tr>
        <td>' . ($index1) . '</td>
        <td> <img src="' . $item['image'] . '" alt="" width="300" height="300"></td>
        <td>' . $item['title'] . '</td>
        <td>' . $status . '</td>
        <td hidden="true" name = "id">' . $item['id'] . '</td>
        <td>
        <a href="show/' . $titlename . '-' . $item['id'] . '.html">show</a>
        <a href="edit/' . $titlename . '-' . $item['id'] . '.html">edit</a>
        <a href="" onclick="deleteCategory(' . $item['id'] . ')" >delete</a>
        </td>
        </tr>';
                        $index1++;
                    }
                    ?>
                    <script type="text/javascript">
                        function deleteCategory(id) {
                            var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
                            if (!option) {
                                return;
                            }

                            console.log(id)
                            //ajax - lenh post
                            $.post('ajax.php', {
                                'id': id,
                                'action': 'delete'
                            }, function(data) {
                                location.reload()
                            })
                        }
                    </script>
                </tbody>
            </table>
        </div>

    </div>
    <div style="display: flex;">

        <div class="col-auto my-1 text-left" style="display: flex;">
            <div>
                <p>page:</p>
            </div>
            <div> <select class="form-select mr-sm-2" id="inlineFormCustomSelect" name="page number" onchange="location = this.value">
                    <option value="" hidden>select page</option>
                    <?php
                    for ($i = 1; $i <= $pages; $i++) {
                        echo '<option value="index.php?page=' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select></div>

        </div>
        <div class="container text-center">
            <ul class="pagination justify-content-center">

                <?php
                $m = (int)$current_page;
                if ($m != 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($m - 1) . '"><<</a></li>';
                }

                for ($i = 1; $i <= $pages; $i++) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($m < $pages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($m + 1) . '">>></a></li>';
                }

                ?>
            </ul>
        </div>


    </div>
</body>

</html>