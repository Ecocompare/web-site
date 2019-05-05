	<div id="news">
			<?=text('Edito')?>
	</div>




	<div class="carrousel">

		<h2><a href="<?=$GLOBALS['base']?>nouveaux-produits-responsables.html" class="more-link">Voir toutes les nouveautés</a>Ajoutés récemment</h2>
			<? $this->productCtrl->showHomeList($this->new); ?>
	</div>

	<div class="carrousel">
		<h2><a href="<?=$GLOBALS['base']?>selection-produits-responsables.html" class="more-link">Voir tous les produits</a>Notre sélection</h2>
			<? $this->productCtrl->showHomeList($this->selection); ?>
	</div>
<script type="text/javascript">
	$(document).ready(function(){ 
        window.setInterval("getRandomTestimony()",7000);        
    }); 

</script>

<div id="testimony">
		<h2>Témoignages</h2>
		
		<div id="testimony_msg">
			<b><?=$this->testimony['subject']?></b><br/>
			&laquo;<?=$this->testimony['description']?>&raquo;.
			<div class="faded"><?=$this->testimony['author']?></div>
			
		</div>
		 
	</div>


		<div class="home-block">
			<h2>Dernier scan</h2>
			<div class="map-bubble">
			
				<div id="map_canvas"></div>
			</div>
		
		</div>
	
	<div class="home-block">
		<h2>Partenaires</h2>
		<!-- <h2><a href="ecoacteur-smartphone.html" class="more-link">Devenez Ecoacteur</a>Top 5 Ecoacteurs</h2>
	<? $i=1;foreach ($this->users as $key=>$user) { ?>
	
			<div class="ecoacteur">
				<img src="<?=$repertoire=$GLOBALS['base'];?>/images/ecoacteurs/ecoacteur_min_<?=$i;?>.png"  alt="Classement ecoacteur, position <?=$i;?>" title="Classement ecoacteur, position <?=$i;?>"/>   
				&nbsp;
			
				<img src="ecoacteur-photo-<?= $user['id'];?>" alt="classement ecoacteur <?= $user['name'];?>" />
			 <b><?= $user['name'];?></b> <br/>&nbsp;&nbsp;<?= $user['total'];?>  scans
			</div>
		<? $i++; } ?>  width="
		-->
		<center>
		<a href="http://www.hepur.fr" target="_blank"><img src="images/plateforme_collaborative_HEPUR_min.gif" alt="Partenaire HEPUR" border="0" width="283"></a>
		</center>
	</div>
	

		
		<div class="home-block">
		<h2>Entreprises engagées<br/></h2>
			<? $count=0;  $companies = $db->getCompanies(0, "rand()");?>
					<? foreach($companies as $key=>$company){ ?>
						<? if ($company['image'] != '' && $count < 12  ){ ?>
							<a href="<?=$GLOBALS['base']?><?=toUrl($company['title'])?>_c<?=$company['id']?>.html" title="<?=$company['title']?>">
										<img src="<?=$GLOBALS['base']?>comparateur-marque-ecologique-<?=toUrl($company['title'])?>-<?=$company['id']; ?>.jpg" alt="Comparer les produits de <?=toUrl($company['title'])?>" class="entreprise" /></a>
						<? $count++; ?>
						<? } ?>
					<? } ?>
						
					<a href="<?=$GLOBALS['base']?>marques-responsables.html" class="more-bottom-link">Voir toutes les entreprises engagées</a>
		</div>
		
		
