<?php 

  require_once('../models/Db.php');
  $db = new Db();
   
   $id = intval($_GET['id']); 
   $type = intval($_GET['type']);
      

  $query = "SELECT `name` , `ratingid` , `points` , productsubratings2.comment
  FROM `subratings2`
  INNER JOIN productsubratings2 ON subratingid = subratings2.id
  WHERE productid = $id AND ratingid = $type";  
 

 
  $results = mysql_query($query);
  echo mysql_error();
  	
  $i = 0; $concat = "";
  while($subratings = mysql_fetch_assoc($results)) {
    
    $concat .= "name$i=".$subratings['name'].";point$i=".$subratings['points'].";comment$i=".$subratings['comment'].";";
    $i++;  
  }
    
  echo "count=$i;";
  echo strip_tags($concat);
