<?php 

 if(isset($_FILES)!=''){
 var_dump($_FILES);
 }


?>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" value="envoyer">
</form>