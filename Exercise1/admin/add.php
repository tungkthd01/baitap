<?php

require_once ('./db/helperdb.php');

$title = $description = $image_url = $status="";
if(!empty($_POST)){
    if (isset($_POST['tit'])){
            $title = $_POST['tit'];
    }
    if (isset($_POST['descrip'])){
        $description = $_POST['descrip'];
    }
    if ($_FILES['img']['type'] == "image/jpeg"|| $_FILES['img']['type'] == "image/png" || $_FILES['img']['type'] == "image/jpg"){
        $path = "./image/";

        $tmp_name = $_FILES['img']['tmp_name'];
        $img_name = $_FILES['img']['name'];
        move_uploaded_file($tmp_name,$path.$img_name);
        $image_url = $path.$img_name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu
        
    }
    $status = $_POST['status'];
    if (!empty($title) && !empty($description)){
        $created_at = $updated_at = date('Y-m-d H:s:i');
        
        // $sql = 'insert into post(title,description,image,status,created_at, updated_at) values ("'.$title.'","'.$description.'" ,"'.$image_url.'","'.$status.'","'.$created_at.'", "'.$updated_at.'")';
        if ($id == '') {
			$sql = 'insert into post(title,description,image,status,created_at, updated_at) values ("'.$title.'","'.$description.'" ,"'.$image_url.'","'.$status.'","'.$created_at.'", "'.$updated_at.'")';
		} else {
			$sql = 'update post set title = "'.$title.'", description ="'.$description.'",image ="'.$image_url.'",status="'.$status.'",updated_at = "'.$updated_at.'" where id = '.$id;
		}

		execute($sql);

		header('Location: http://localhost/Exercise1/admin/manage.html');
		die();
    }
}
