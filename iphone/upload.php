<?php 

   header('Access-Control-Allow-Origin: *');
   
// Configuration - Your Options
  $allowed_filetypes = array('.jpg','.gif','.bmp','.png','.jpeg'); // These will be the types of file that will pass the validation.
  $max_filesize = 2524288; // Maximum filesize in BYTES (currently 0.5MB).
  $upload_path = './usersImages/'; // The place the files will be uploaded to (currently a 'files' directory).
 
   $filename = $_FILES['file']['name']; // Get the name of the file (including file extension).
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
    
	var_dump($_FILES['file']);
	
   // Check if the filetype is allowed, if not DIE and inform the user.
  // if(!in_array($ext,$allowed_filetypes))
  //print('The file you attempted to upload is not allowed.');
 
   // Now check the filesize, if it is too large then DIE and inform the user.
   if(filesize($_FILES['file']['tmp_name']) > $max_filesize)
  print('The file you attempted to upload is too large.');
 
   // Check if we can upload to the specified path, if not DIE and inform the user.
   if(!is_writable($upload_path))
  print('You cannot upload to the specified directory, please CHMOD it to 777.');
 
   // Upload the file to your specified path.
   if(move_uploaded_file($_FILES['file']['tmp_name'],$upload_path . $filename))
     echo 'upload success'; // It worked.
  else
     echo 'upload error'; // It failed :(. 


?>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" value="envoyer">
</form>


