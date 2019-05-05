<script>


	function affOnglet (nbonglets, elm, idconteneur){
		var nom = "methodo_onglet";
		for (var i=1; i <= nbonglets ; i++){
			var monOnglet = document.getElementById(nom + i);
			monOnglet.className = 'methodo_onglet';
		}
		elm.className = 'methodo_encours';
		
		nom = "methodo_contenu";
		for (var j=1; j <= nbonglets ; j++){
			var monOnglet = document.getElementById(nom + j);
			monOnglet.className = 'invisible';
		}
		var conteneur = document.getElementById(idconteneur);
		conteneur.className = 'methodo_contenu_onglet';	
	}	
			
	box1 = new ecocompare_lightbox("methodo_shadowing1", "methodo_lightbox1");
	box2 = new ecocompare_lightbox("methodo_shadowing2", "methodo_lightbox2");
	box3 = new ecocompare_lightbox("methodo_shadowing3", "methodo_lightbox3");
	box4 = new ecocompare_lightbox("methodo_shadowing4", "methodo_lightbox4");
	box5 = new ecocompare_lightbox("methodo_shadowing5", "methodo_lightbox5");
	box6 = new ecocompare_lightbox("methodo_shadowing6", "methodo_lightbox6");
		
</script>
<div style="font-weight : bold; text-align : center;font-size : 20px;">La méthodologie de notation ecocompare</div></br>

<div id="methodo_conteneur_global">
	<!--DEBUT NAVIGATION-->
	<div id="methodo_navigation">
		<div class="methodo_encours" id="methodo_onglet1" onClick="affOnglet (4, this, 'methodo_contenu1');">Intro</div>
		<div class="methodo_onglet" id="methodo_onglet2" onClick="affOnglet (4, this, 'methodo_contenu2');">Principe de Note Idéale</div>
		<div class="methodo_onglet" id="methodo_onglet3" onClick="affOnglet (4, this, 'methodo_contenu3');">Formules de calcul</div>
		<div class="methodo_onglet" id="methodo_onglet4" onClick="affOnglet (4, this, 'methodo_contenu4');"><strong>Contact</strong></div>
	</div>
	<!--FIN NAVIGATION-->

	<!--DEBUT CONTENEURS-->
	<div id="methodo_shadowing1" onClick="box1.closebox();"></div>
	<div id="methodo_shadowing2" onClick="box2.closebox();"></div>
	<div id="methodo_shadowing3" onClick="box3.closebox();"></div>
	<div id="methodo_shadowing4" onClick="box4.closebox();"></div>
	<div id="methodo_shadowing5" onClick="box5.closebox();"></div>
	<div id="methodo_shadowing6" onClick="box6.closebox();"></div>

	<!--contenu onglet1-->   
	<div class="methodo_contenu_onglet" id="methodo_contenu1">
		<p><div style="float : right;height : 150px;"></br><img style="margin-left : 20px;vertical-align : middle;max-width : 130px;float : right;" src="<?php $_GLOBAL['base']?>images/methodo/labels1.png"/></div>Nous utilisons une approche systémique basée sur <strong>l'attribution de points selon des critères qualitatifs et positifs</strong> pour valoriser les efforts réalisés par les fabricants et les distributeurs sur les axes Environnement, Santé, et Sociétal. <strong>Tous les points doivent être clairement justifiés par le fabricant pour être validés : </strong>label, photo du packaging ou de la notice d'utilisation, attestation sur l'honneur, preuve quantitative. Ces preuves doivent respecter les lignes directrices relatives à l'utilisation et à l'évaluation des déclarations environnementales de la norme ISO14021. <strong>La notation concerne le couple produit-emballage sur l'ensemble de son cycle de vie</strong> en prenant en compte toutes les étapes, du choix des matières premières à la fin de vie.
		</p></br>
		<p><div style="float : left;height : 150px;"></br><img style="margin-top : 30px;margin-right : 20px;vertical-align : middle;max-width : 130px;float : right;" src="<?php $_GLOBAL['base']?>images/methodo/feuilles_ecoco.png"/></div>La méthodologie compte en tout <strong>75 critères environnementaux, 27 critères sociétaux et 18 critères sanitaires.</strong> Les produits référencés sont répartis selon 10 types de produit. Afin de faciliter le travail des entreprises qui souhaitent référencer leurs produits, seuls les critères pertinents étant donné le type du produit référencé leurs sont proposés.</br></br><strong>Les trois axes (environnement, santé, sociétal)</strong> sont notés en fonction du produit idéal de chaque type de produit (Voir les explications de la notion de note idéale à l’onglet suivant).
		</p>
	</div>
	<!--contenu onglet2-->
	<div class="invisible" id="methodo_contenu2">
		<p><div style="float : right;height : 190px;"></br><img style="margin-top : 30px;margin-left : 20px;vertical-align : middle;max-width : 150px;float : right;" src="<?php $_GLOBAL['base']?>images/methodo/badge.png"/></div>Plusieurs choix de notations auraient pu être retenus. Par exemple une notation dynamique  qui  mettrait  à  jour  toutes  les  notes  lors  du  référencement  d’un  nouveau produit. Mais cela signifierait d’une part que le premier produit référencé par type de produit  obtiendrait  nécessairement  la  note  maximale  alors  qu’il  n’est  pas  forcément vertueux et d’autre part que l’entreprise ne pourraient communiquer par formats print sur  ses  performances  selon  la  présente  méthodologie  car  la  note  changerait  en permanence à mesure que des produits sont nouvellement référencés. C’est pour cette raison que <strong>nous avons choisi le concept de note idéale,</strong> à savoir une  note  qui  représente  pour  l’année  considérée,  par  type  de  produit  et  par  axes  et sous-axes, ce qui se fait de mieux, évitant ainsi les deux écueils ci-dessus. 
		</p>
		<p><div style="float : left;height : 170px;"></br><img style="margin-right : 20px;vertical-align : middle;max-width : 150px;float : left;" src="<?php $_GLOBAL['base']?>images/demarche/verteego.png"/></div><strong>Les  produits  référencés  sont  alors  évalués  par  rapport  à  ces  notes  idéales,</strong> références absolues et figées sur une année donnée et remises à jour chaque année afin de prendre en compte l’évolution des bonnes pratiques. Ces  notes  idéales  par  axes  et  sous-axes  et  selon  le  type  de  produit  ont  été estimées  sur  la  base  du  savoir-faire  <a  target="_blank" href="http://www.verteego.com/fr">Verteego</a>.  Elles  correspondent  pour  les  axes Environnement, Santé et Sociétal aux situations décrites ci-dessous :
		
		</p><div style="font-weight : bold; text-align : center;"><a href="#" onClick="box4.openbox();">Environnement</a>, <a href="#" onClick="box5.openbox();">Santé</a> et <a href="#" onClick="box6.openbox();">Sociétal</a>.</div>
	</div>
	<!--contenu onglet3-->
	<div class="invisible" id="methodo_contenu3">
		<p><strong>Les formules de calculs </strong>sont données par axes de notation conformément au principe de note idéale décrit précédemment  (Cliquez sur chaque axe pour obtenir le détail des calculs) : 
		<p>
		<div style="text-align : center;">
		<a href="#" onClick="box1.openbox();">Environnement</a></br>
		+</br>
		<a href="#" onClick="box2.openbox();">Sociétal</a></br>
		+</br>
		<a href="#" onClick="box3.openbox();">Santé</a>
		</div>
		<p>La note finale sur 5 est alors la moyenne des trois notes sur 5 des parties environnement, sociétal et santé. Cette note est appelée<strong> note globale du produit.</strong>
		</p>

		
		<img alt="Calcul note sociétale globale" src="images/methodo/calcul_noteGlobale.png">
		
	</div>
	<!--contenu onglet4-->
	<div class="invisible" id="methodo_contenu4">

		<div style="float : right;height : 170px;"></br><img style="margin-top : 45px;margin-left : 60px;vertical-align : middle;max-width : 190px;float : right;" src="<?php $_GLOBAL['base']?>images/demarche/verteego.png"/></div>Pour toute question relative à la méthodologie, merci de contacter  :
		</br></br><div style="text-align : left;">
		Olivier Baboulet</br>
		Direction scientifique</br> Verteego</br> 01 77 14 10 68</br> <a href="mailto:contact@verteego.com">contact@verteego.com</a>
		</div></br></br>
		<div style="float : left;height : 145px;"></br><img style="margin-top : 10px;margin-right : 20px;vertical-align : middle;max-width : 130px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/contact.png"/></div>Si vous souhaitez découvrir  <strong>comment référencer vos produits, </strong> les avantages qu’ecocompare vous procure ainsi que les entreprises déjà engagées rendez vous sur la page <a target="_blank" href="http://www.ecocompare.com/demarche-ecocompare.html">Référencez vos produits</a> !

		</br></br>Pour toute question relative à la plateforme ecocompare dans sa globalité, contactez-nous à l’adresse suivante <a href="mailto:contact@ecocompare.com">contact@ecocompare.com</a> ou au 04.75.70.18.11.


	</div>
	<!--FIN CONTENEURS-->
				<!-- onglet "formules de calcul" -->
	<!-- DEBUT CONTENU LIGHTBOX 1 -->
	<div id="methodo_lightbox1">
		<div style="float : left;height : 510px;padding-right : 10px;"></br><img style="margin-top : 42px;margin-right : 5px;max-width : 75px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/feuille_ecoco.png"/></div>
		<div style="float : right;width : 650px;">
			<div class="boxheader">Note environnement</div>
			<p>Le produit est d’abord affecté d’une note correspondant au nombre de critères validés et leurs pondérations respectives pour chacune des 6 étapes du cycle de vie le concernant (matières premières, fabrication, logistique amont, logistique aval, utilisation et fin de vie).Ces 6  notes sont ensuite ramenées sur 5 par une règle de trois, la valeur de 5 correspondant à la note idéale.
			</p>
			<img alt="image note produit" src="images/methodo/calcul_noteproduit.png">	
			</br>
			<p>L’emballage est également affecté d’une note correspondant au nombre de critères validés et leurs pondérations respectives pour chacune des 5 étapes du cycle de vie le concernant (matières premières, fabrication, logistique amont, utilisation et fin de vie). Ces 5 notes sont ensuite ramenées sur 5 par une règle de trois, la valeur de 5 correspondant à la note idéale.
			</p>	
			<img alt="note emballage" src="images/methodo/calcul_noteemballage.png">
			</br>	
			<p>Ces notes sur 5 sont ensuite moyennées pour former une unique note « environnement » pour le couple produit/emballage. La moyenne intervient une fois les notes ramenées sur 5 afin d’éliminer le bais induit par un nombre différent de critères par sous-axes.
			</p>
			<img alt="calcul notre environnement" src="images/methodo/calcul_noteEnvironnement.png">
		</div>			<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 1 -->
	<!-- DEBUT CONTENU LIGHTBOX 2 -->
	<div id="methodo_lightbox2">
		<div class="boxheader">Note Sociétale</div>
		<div style="float : left;height : 600px;margin-left: -10px;padding-right : 5px;"></br><img style="margin-top : -5px;margin-right : 5px;max-width : 85px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/societal.jpg"/></div>
		<p>Pour la partie « sociétal » tous les critères valent un point. Une note intermédiaire, correspondant au nombre de critères validés, est calculée pour chacun des sous-axes de la « partie sociétal ». Ces 4 notes (qualité, éthique, social, équitable) sont ensuite ramenées sur 5 par une règle de trois, la valeur de 5 correspondant à la note idéale.
		</p>
		<img alt="Calcul note sociétale détail" src="images/methodo/calcul_noteSocietal.png">
		<p>Ces 4 notes ramenées sur 5 sont ensuite moyennées pour former une unique note « sociétal » pour le couple produit/emballage. La moyenne des notes des quatre sous-axes intervient une fois les notes ramenées sur 5 afin d’éliminer le bais induit par le nombre différent de critères par sous-axes.
		</p>
		<img alt="Calcul note sociétale globale" src="images/methodo/calcul_noteSocietal_global.png">
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 2 -->
	<!-- FIN CONTENU LIGHTBOX 3  -->
	<div id="methodo_lightbox3">
		<div class="boxheader">Note Santé</div>
		<div style="float : left;height : 140px;margin-left: -10px;padding-right : 5px;"></br><img style="margin-top : -5px;margin-right : 5px;max-width : 75px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/sante.jpg"/></div>
		<p>Pour la partie « santé » tous les critères valent 0,5 point. De base, nous octroyons une note de 2,5 à chaque produit. Cette note, offrant de base la moyenne, a pour but de refléter le fait que si le produit est sur le marché c’est qu’il a satisfait aux exigences sanitaires élémentaires, sinon il en serait retiré ou n’y serait jamais arrivé.
		</p>
		<img style="margin-right : -20px;float : right;text-align : right;" alt="calcul note santé" src="images/methodo/calcul_noteSante.png">
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 3 -->
					<!-- onglet "principe de note idéale" -->
	<!-- DEBUT CONTENU LIGHTBOX 4 -->
	<div id="methodo_lightbox4">
		<div class="boxheader">Note environnement</div>
		<div style="float : left;height : 200px;margin-left: -10px;padding-right : 5px;"></br><img style="margin-top : -5px;margin-right : 5px;max-width : 75px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/feuille_ecoco.png"/></div>
		<p>Un produit idéal est un couple produit/emballage dont le choix des matières premières et la fabrication sont pensés de manière à <strong>réduire l'écotoxicité et l'impact sur les ressources naturelles</strong> à iso-fonction, dont l'approvisionnement en matières premières est aussi local que possible et dont <strong>la distribution est optimisée </strong>tant en termes de routes commerciales, de moyens de transports que de chargement de ces derniers. C’est également un couple produit/emballage dont la <strong>durée de vie est maximisée</strong> dès sa conception ainsi que par le biais d'informations et recommandations permettant son bon entretien et sa bonne utilisation. Enfin c’est un couple produit/emballage conçu de manière à être <strong>le plus valorisable en fin de vie,</strong> que ce soit par le recyclage ou par réutilisation de tout ou partie des pièces le composant, et dont les moyens de valorisation et d’élimination les plus adaptés sont clairement indiqués à l'utilisateur.
		</p>
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 4 -->
	<!-- DEBUT CONTENU LIGHTBOX 5-->
	<div id="methodo_lightbox5">
		<div class="boxheader">Note santé</div>
		<div style="float : left;height : 300px;margin-left: -10px;padding-right : 5px;"></br><img style="margin-top : -5px;margin-right : 5px;max-width : 75px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/sante.jpg"/></div>
		<p>La santé est particulière en cela que tout un chacun ne réagit pas de la même manière aux expositions subies quotidiennement et que ces différences peuvent être lourdes de conséquences très rapidement au contraire des autres axes évalués dans la méthodologie ecocompare. C’est pourquoi nous avons délibérément choisi de ne pas appliquer le même concept de note idéale à cet axe. Au contraire, de base,<strong> nous octroyons une note de 2.5 à chaque produit.</strong> Cette note, offrant de base la moyenne, a pour but de refléter le fait que si le produit est sur le marché c’est qu’il a <strong>satisfait aux exigences sanitaires élémentaires,</strong> sinon il en serait retiré ou n’y serait jamais arrivé. A partir de cette note de base, pour chaque critère Santé validé un demi-point supplémentaire est attribué. Dans le cas où tous les critères sont validés, et uniquement dans ce cas, la note de 5 sur 5 est accordée. Plus la note est élevée, plus elle reflète d’une part <strong>l’absence de danger associé aux composants du produit</strong> et d’autre part <strong>la diminution du risque « d’effet cocktail ».</strong> Cette approche, volontairement conservative, se veut avant tout préventive pour le consommateur (prévention en vue d’éviter des désagréments de santé) et incitative pour le producteur (incitation à trouver des alternatives utilisant toujours moins de composants dangereux, même en infime quantité).
		</p>
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 5 -->
	<!-- FIN CONTENU LIGHTBOX 6 -->
	<div id="methodo_lightbox6">
		<div class="boxheader">Note sociétale</div>
		<div style="float : left;height : 320px;margin-left: -10px;padding-right : 5px;"></br><img style="margin-top : -5px;margin-right : 5px;max-width : 75px;float : left;" src="<?php $_GLOBAL['base']?>images/methodo/societal.jpg"/></div>
		<p>Un produit idéal est un produit qui remplit correctement et <strong>sans risque pour la sécurité du consommateur</strong> les fonctionnalités pour lesquelles il a été conçu. C'est un produit dont la chaîne d'approvisionnement permet le maintien et le <strong>développement du tissu économique local et régional</strong> tout en établissant des <strong>conditions équitables de commerce</strong> dans le cas d’échanges internationaux et ce, quelque soit le pays en question. C'est également un produit pour lequel des <strong>règles de transparence et d'éthique</strong> ont présidé depuis sa conception jusqu'à sa mise sur le marché (pas de tests sur les animaux lors de sa conception, pas d'ingrédients issus d’espèces protégées lors de sa fabrication, pas de greenwashing ni de condamnation de la part de la DGCCRF lors de sa commercialisation, etc.).
		</p>
		
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 6 -->
	</br></br>
</div>