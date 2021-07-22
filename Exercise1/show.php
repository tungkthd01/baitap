<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/Exercise1/">
    <title>Post</title>
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

        .ridge {
            border-style: ridge;
        }
    </style>
</head>


<body>
    <div class="">
        <div class="text-right">
            <a href="manage.html">
                <button class="btn btn-default send">back</button>
            </a>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center
            height">
        <div class="card py-3">
            <?php
            require_once('./admin/db/helperdb.php');
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
            echo '<div class="p-3 d-flex align-items-center justify-content-center">
                    <h2>'.$title.'</h2>
                </div>
                <div class="p-3 px-4 py-2">
                <img src="./admin/'.$image_url.'" alt="" width="300" height="300">
                <p class="ridge">'.$description.'</p>
                </div>';
            ?>
        </div>
</body>

</html>