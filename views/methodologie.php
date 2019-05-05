<div >

	<script type="text/javascript">
				$(document).ready(function(){ 
					var anchorName = document.location.hash.substring(1);
			  $(function () {
			    if(anchorName) {
			      $("#cat"+anchorName).slideToggle("slow");
			    }
			  });
					});
			</script>
			
		<?php
		//on recherche les thèmes
		$theme=$db->getThemes();
		
			foreach ($types as $key=>$type){?>
				<script type="text/javascript">
					
					$(document).ready(function(){ 
	
				$("#lien<?=$type['id']?>").click(function () {
	      $("#cat<?=$type['id']?>").slideToggle("slow");
	   		 });
	  		});
	  
	 			 </script>
	    
				<h2> <a class="cursor" name="<?=$type['id']?>"  id='lien<?=$type['id']?>'  >+ <?=$type['name']?></a></h2>
				
				<!-- Div qui ouvre / ferme -->
				<div  style="display:none;" id="cat<?=$type['id']?>" class="ratings">
					<b>Description</b><br>
					<p style="text-align:justify;"><?=$type['comment']?></p><br/>
					
					<b>Exemple</b><br>
					<p style="text-align:justify;"><?=$type['example']?></p><br/>
					
						<!-- ############## ENVIRONNEMENT -->
						<div class="ratingdetail">
							<div class="ratinglabel">
							<? echo $theme[0]['name']; ?>
							</div>
							<div >
						
							<? $lifecycles = $db->getLifecycles();
								 foreach ($lifecycles as $key=>$lifecycle){ ?>
		
									<script type="text/javascript">
									
									$(document).ready(function(){ 
					
									$("#lienx<?=$lifecycle['id']?>-<?=$type['id']?>").click(function () {
					     		 $("#catx<?=$lifecycle['id']?>-<?=$type['id']?>").slideToggle("slow");
					   			 });
					  				});
					     	 </script>
		             
									<div class="subratingdetailopen" style="width:650px;">
										<span>Score idéal +<? echo $db->getMaxScore($type['id'],1,$lifecycle['id']);?>pts</span>
										<div class="tooltip2" style="width:450px;">
											<a class="cursor" name="<?=$lifecycle['id']?>-<?=$type['id']?>"  id='lienx<?=$lifecycle['id']?>-<?=$type['id']?>'><img border="0" src="style/expand.png"/><strong> <?=$lifecycle['name']?></strong></a>
										</div>
										<div  style="display:none;" id="catx<?=$lifecycle['id']?>-<?=$type['id']?>" class="opendetail">
											
												<? $criterias=$db->getSubratings2($type['id'],0,$lifecycle['id'],0); 
													 foreach ($criterias as $key=>$criteria){ 
													 	?>
														 	<div class="subratingdetail" style="width:580px;">
																	<span>+<? echo ($criteria['points']-floor($criteria['points'])==0)?round($criteria['points']):$criteria['points'];?>pts</span>
																	<div style="width:20px;"> 
																		 <a href="#" class="tooltip"><img src="http://www.ecocompare.com/images/help.png" alt="Aide <?=$criteria['name']?>" /><span><?=nl2br($criteria['question']."<br/><hr/>".$criteria['example']);?></span></a>
																	</div>
																	<div class="tooltip2" style="width:470px;">
																		<strong><?=$criteria['name']?></strong>
																		<br/>
																	</div>
															</div>
													<? } ?>
												
									 </div>
									 
									</div>
						
						   <? } ?>	
						
												
							</div>
					</div>
						<!--############## SANTE ETHIQUE ET QUALITE ########### -->
					
						<?php for($i=2;$i<=7;$i++) { ?>
					
								<div class="ratingdetail">
									<div class="ratinglabel"><?echo $theme[$i-1]['name']; ?>
									</div>
										<div >
											<div class="subratingdetailopen" style="width:650px;">
												<span>Score idéal +<? echo $db->getMaxScore($type['id'],$i,0);?>pts</span><br/>
											
												<div  id="catx<?=$lifecycle['id']?>-<?=$type['id']?>" class="opendetail">
													
														<? if ($i==6) {$criterias=$db->getSubratings2(0,$i,0,0);} else {$criterias=$db->getSubratings2($type['id'],$i,0,0);}
														
															 foreach ($criterias as $key=>$criteria){ ?>
																 	<div class="subratingdetail" style="width:580px;">
																	<span>+<? echo ($criteria['points']-floor($criteria['points'])==0)?round($criteria['points']):$criteria['points'];?>pts</span>
																		<div style="width:20px;"> 
																		 <a href="#" class="tooltip"><img src="http://www.ecocompare.com/images/help.png" alt="Aide <?=$criteria['name']?>" /><span><?=nl2br($criteria['question']."<br/><hr/>".$criteria['example']);?></span></a>
																	</div>
																		<div class="tooltip2" style="width:470px;">
																			<strong><?=$criteria['name']?></strong>
																			<br/>
																		</div>
																 </div>
															 	<?}?>
															
										 		</div>
										 <div>
										</div>
								</div>
							
							
							<br/>
							</div>
						</div>
							<?}?>
		
				</div>
		
		<?}?>


</div>