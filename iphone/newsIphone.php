<?php


  require_once('../models/Db.php');
  $db = new Db();
  
  $limit = (isset($_GET['limit'])) ? intval($_GET['limit']) : 0;
  
  $query = "SELECT * FROM products_old WHERE published = 'true' ORDER BY pubdate DESC limit $limit, 15";
  $results = mysql_query($query);
  
  $i = 0; $concat = "";
  while($product = mysql_fetch_assoc($results)) {
    
    $concat .= "id$i=".$product['id'].";name$i=".$product['name'].";brand$i=".$product['brand'].";rating$i=".round($product['rating4'],1).";";
    $i++;   
  }
  
  echo "count=$i;";
  echo $concat;
  
  //echo "count=15;id0=343;name0=Soda Quick distributeur eau gazeuse;brand0=HomeBar ;rating0=4;id1=342;name1=Couches Lavables ;brand1=Bambi'Net;rating1=4;id2=340;name2=body garçon lime la.tribbu;brand2=la.tribbu;rating2=3;id3=339;name3=Tablettes Lave-Vaisselle Tout-en-Un au Sel Minéral;brand3=RAINETT;rating3=4;id4=336;name4=Liquide vaisselle crème citron 750ml;brand4=RAINETT;rating4=4;id5=335;name5=Lessive liquide aloe vera sensitive;brand5=RAINETT;rating5=4;id6=324;name6=Liquide vaisselle écologique;brand6=ECODOO;rating6=4;id7=323;name7=Lessive liquide écologique;brand7=ECODOO;rating7=4;id8=334;name8=Accessoires en Raphia;brand8=ETHOS PARIS;rating8=4;id9=332;name9=Sac Shakoche;brand9=Deux Filles en Fil;rating9=3;id10=331;name10=Chaussures;brand10=El Naturalista;rating10=4;id11=330;name11=Bottes Geisha Bleu Marine;brand11=COMO NO;rating11=3;id12=327;name12=FYE subshoes;brand12=FYE (For Your Earth);rating12=4;id13=322;name13=Women's R3 Hi-Loft Hoody;brand13=Patagonia;rating13=4;id14=321;name14=PBM bloc parpaing bois massif;brand14=PBM bloc;rating14=5;";
