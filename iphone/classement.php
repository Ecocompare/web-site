<?php
require_once '../models/Db.php';
$db = new Db();
$GLOBALS['base'] = "http://www.ecocompare.com/";


$mobile_id = null;

if(isset($_GET['mobile_id'])) 
{
  $mobile_id = strip_tags($_GET['mobile_id']);
}

?>


<html>
	<head>
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />


		<style type="text/css">
			body {
				background-color: #f1f1f1;
				margin: 5px; 
				padding: 0;
				font-size: 16px;
				font-family: Arial;
			}

			h1 {
				color: black;
				padding-bottom: 10px;
				margin: 0px;
				font-size: 22px;
				line-height: 24px;
				font-weight: bold;
			}

			table {
				width: 99%;				
				border-collapse: collapse;
				border: 1px solid #c4c4c4;				
			}

			td {	
				border-style: solid;
				border-width: 1px;
				border-color: #bacae0;
				line-height: 15px;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-right: 6px;
				padding-left: 6px;
				text-align: center;
			}

			.trHeader {
				background-color: #BCE2A7;
				font-weight: bold;
			}

			.user {
				font-weight: bold;
				color: #006600;
			}
  		</style>


	</head>

	<body>


		<center><h1>
			Classement des 15 eco-acteurs<br />
			les plus actifs (<?php echo utf8_encode(ucwords ($db->getMonth(Date('m'))));?>) 
		</h1></center>

		<p>Ce tableau r&eacute;capitule le classement des eco-acteurs ayant le plus scann&eacute;s de codes barre uniques pour le mois en cours avec leur application ecocompare (rafraichissement toutes les 10 minutes).</p>
		<br/>


		<center>
			<table>
				<tr class="trHeader">
					<td>Position</td>
					<td>Nom</td>
					<td>Nb de scan</td>
					<td>dont produits verts</td>
				</tr>


				<?php 
					$month=Date('m');
					$year=Date('Y');
		  
					$query="SELECT max(totalproduitvert) as max  from iphone_query_month A, iphone_users B where A.user_id=B.id and month='$month' order by total desc, totalproduitvert desc";
		  			$results = mysql_query($query);
		  			$result = mysql_fetch_assoc($results);
		  			echo mysql_error();
		  			$maxgreen=$result['max'];
		 
					$query="SELECT B.iphone_id,email,name,tel,total,totalproduitvert,month,FB_id,win_max,win_maxgreen from iphone_query_month A, iphone_users B where A.user_id=B.id and month='$month' and year='$year'  order by total desc, totalproduitvert desc, name asc";
					$results = mysql_query($query); 
		 
		 			$i=0;        
		 			$my_position=0;   
		 			$my_scan=0;    

		 			while ($row = mysql_fetch_assoc($results)) 
					{

						$i++;
						//mon classement
						//echo $row['email']."::".$user_id;



						if ($mobile_id != null && $mobile_id == $row['iphone_id'])
						{
							echo '<tr class="user">';
						}
						else { echo '<tr>'; }
				?>

						

							<td>
				 				<?=$i;?>
							</td>



							<td>
								<?php echo utf8_decode($row['name']); ?>
							</td>



							<td>
								<?if ($row['win_max'] ) echo "<b>"; ?>
								<?= $row['total'];?>
								<?if ($row['win_max'] ) echo "</b>"; ?>
							</td>



							<td>
								<?if ($row['win_maxgreen'] ) echo "<b>"; ?>
								<?= $row['totalproduitvert'];?> (<?=round($row['totalproduitvert']*100/$row['total']); ?> %)
								<?if ($row['win_maxgreen'] ) echo "</b>"; ?>
							</td>



						</tr>

					<?}?>

			</table>
		</center>
		
	</body>
</html>
