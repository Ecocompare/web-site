<?php


$iphone_id = $_POST['iphone_id'];
move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) ."/usersImages/" . $iphone_id . ".png");