<?php 

  require_once('models/Db.php');
  $db = new Db();
   
   $id = intval($_GET['id']); 
   $type = intval($_GET['type']);
      

  $query = "SELECT `name` , `ratingid` , `points` , productsubratings.comment
  FROM `subratings`
  INNER JOIN productsubratings ON subratingid = subratings.id
  WHERE productid = $id AND ratingid = $type";  
  $results = mysql_query($query);
  
  $i = 0; $concat = "";
  while($subratings = mysql_fetch_assoc($results)) {
    
    $concat .= "name$i=".$subratings['name'].";point$i=".$subratings['points'].";comment$i=".$subratings['comment'].";";
    $i++;  
  }
    
  echo "count=$i;";
  echo strip_tags($concat);
