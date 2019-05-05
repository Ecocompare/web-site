<?php


$android_id = $_GET['android_id'];
move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) ."/usersImages/" . $android_id . ".png");
