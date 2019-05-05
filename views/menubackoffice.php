	<div class="sideblock">
				<h2>Menu administration</h2>
				<ul>
				<? if ($GLOBALS['ctrl'] == 'Product' && $GLOBALS['action'] == 'admin') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>products/admin/" class="<? echo $class; ?>">Fiches produits</a></li>

				<? if ($GLOBALS['ctrl'] == 'Product' && $GLOBALS['action'] == 'justify') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>products?action=justify" class="<? echo $class; ?>">Justificatifs produits</a></li>
				
				
				<? if ($GLOBALS['ctrl'] == 'Typepdt') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>typepdt?action=admin" class="<? echo $class; ?>">Types produits</a></li>
				
				<? if ($GLOBALS['ctrl'] == 'Category') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>categories?action=admin" class="<? echo $class; ?>">Catégories</a></li>
				
				<? if ($GLOBALS['ctrl'] == 'Subrating') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>subratings?action=admin" class="<? echo $class; ?>">Critères de notation</a></li>
								
				<? if ($GLOBALS['ctrl'] == 'Label') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>labels?action=admin" class="<? echo $class; ?>">Labels</a></li>
								
				<? if ($GLOBALS['ctrl'] == 'Match') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>matches/admin" class="<? echo $class; ?>">Matchs</a></li>
				
				<? if ($GLOBALS['ctrl'] == 'Article') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>articles?action=admin" class="<? echo $class; ?>">Dossiers</a></li>
				
					<? if ($GLOBALS['ctrl'] == 'New') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>news?action=admin" class="<? echo $class; ?>">Actualités</a></li>
				

				<? if ($GLOBALS['ctrl'] == 'Comment') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>comments/admin" class="<? echo $class; ?>">Commentaires</a></li>				


				<? if ($GLOBALS['ctrl'] == 'FreeText') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>content?action=admin" class="<? echo $class; ?>">Textes</a></li>

				<? if ($GLOBALS['ctrl'] == 'User') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>users/admin" class="<? echo $class; ?>">Comptes Utilisateurs</a></li>


				<? if ($GLOBALS['ctrl'] == 'Company') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>companies?action=admin" class="<? echo $class; ?>">Entreprises engagées</a></li>

				<? if ($GLOBALS['ctrl'] == 'Ean') { $class = "on"; }else{ $class = "off"; } ?>
				<li class="<?=$class?>"><a href="<?=$GLOBALS['base']?>ean?action=edit" class="<? echo $class; ?>">Codes ean</a></li>



				</ul>
				</div>
					<div class="sideblock faded">
					<h2>Statistiques</h2>
					<table class="stats" >
					<tr><td style="text-align:left;">Nb de produits :</td><td> <?php echo $this->nb_products?></td></tr>
					<tr><td style="text-align:left;">Nb d'ecoacteurs :</td><td><?php echo $this->nb_ecoacteur_total?></td></tr>
					<tr><td style="text-align:left;">dont actifs : </td><td><?php echo $this->nb_ecoacteur_actif?></td></tr>
					
					<tr><td style="text-align:left;">Nb total de scans : </td><td><?php echo $this->nb_iphone_scan?></td></tr>
					<tr><td style="text-align:left;">Nb total de requetes : </td><td><?php echo $this->nb_iphone_request?></td></tr>
					
					<tr><td style="text-align:left;">Nb total de scans pour ce mois: </td><td><?php echo $this->stats['nb_total_scan_thismonth']?></td></tr>
					<tr><td style="text-align:left;">Nb total d'ecoacteurs pour ce mois: </td><td><?php echo $this->stats['nb_user_scan_thismonth']?></td></tr>
					
					<tr><td style="text-align:left;">Nb total eans : </td><td><?php echo $this->nb_ean_total?></td></tr>
					<tr><td style="text-align:left;">% libellés eans : </td><td><?php echo round($this->nb_ean_desc*100/$this->nb_ean_total)?> %</td></tr>
				</table>
						
					</div>