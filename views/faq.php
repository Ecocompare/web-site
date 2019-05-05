<script>


$(document).ready( function () {
	$(".contenu").hide();   
  
  
  var largeur = document.documentElement.clientWidth,
  hauteur = document.documentElement.clientHeight;
   
  var source = document.getElementById('conteneur_faq');
  var haut = 80*hauteur/100;
  source.style.height = haut +'px';
 
    $(".titre").click( function () {
		if( $(this).next(".contenu").is(':visible') ){
			$(this).next(".contenu").slideUp("normal");
 			$(this).children("img").attr("src","style/expand2.png");
		}	
		else{
			$(this).next(".contenu").slideDown("normal");
			$(this).children("img").attr("src","style/expand.png");
		}
    });
	
});
</script>
<style>
.titre:hover{
	cursor : pointer;
}

#conteneur_faq{
	overflow-y : auto;
}

</style>


<div id="conteneur_faq">
<h1>FAQ</h1>
<!--
<p><a href="#sources">D'ou proviennent les informations ?</a><br>
<a href="#notation">Comment sont notés les produits ?</a><br>
<a href="#acv">Quelle méthode utilisée ?</a><br>
<a href="#ecoacteur">Comment devenir eco-acteur et quel intéret ?</a> <br>
<a href="#smartphone">A quoi sert l'application iPhone ?</a><br>
<a href="http://projets2.idnext.net/ecocompare/blank.php#fabricant">Je suis fabricant, quels sont les avantages d'une publication ecocompare ?</a></p><p><a href="#selection">Le produit que je propose sur mon propre site est cité sur ecocompare</a><br><a href="#lien">Je souhaite mettre un lien d'un produit vers ma boutique</a><br>
<a href="#participer">Comment puis-je participer ?</a><br>
<a href="#ecobilan">Je souhaite obtenir l'écobilan des produits de mon entreprise</a><br></p>
-->


<br>
<a class="titre" name="sources"><img src="style/expand2.png" />&nbsp;<b>D'ou proviennent<span style="font-weight: bold;"> les informations</span></b></a>
<div  class="contenu" ><br>Les informations affichées sur les fiches produits et utilisées par notre algorithme de notation sont toutes fournies&nbsp; par les fabricants. L'équipe d'ecocompare vérifie alors si les informations ont été correctement saisies, sont justifiées et cohérentes (vérification&nbsp;des labels&nbsp;et filières existantes par exemple). Aucune note ne peut être attribuée sans une justification, preuve ou attestation sur l'honneur de la part des fabricants.<br></div>
</br></br><a  class="titre" name="notation"><img src="style/expand2.png" />&nbsp;<b>Comment sont notés les produits ?</b></a>
<div class="contenu" ><br>Le site ne propose pas un écobilan basé sur une Analyse quantittative du Cycle de Vie (ACV) mais une notation <strong>positive</strong> et <strong>qualitative</strong>. Nous récompensons le fabricant à chaque fois qu'il à mis en oeuvre des actions volontaires (eco-conception par exemple) pour minimiser les impacts environnementaux, améliorer les&nbsp;conditions de&nbsp;travail ou bannir des substances nocives connues ou suspectes.&nbsp;Nous sommes partisans <strong>d'une écologie positive</strong> et mettons en avant les entreprises qui font des efforts et s'améliorent !
	<p style="text-align: justify;"><br>Pour chaque produit, nous affichons une note sur 5 pour les 5 thèmes principaux : </p>
	<table border="0"><tbody><tr><td>
	<p style="text-align: justify;">- Environnement (avec les 5 étapes du cycle de vie)</p><p style="text-align: justify;">- Santé</p><p style="text-align: justify;">- Social</p><p style="text-align: justify;">- Ehique </p><p style="text-align: justify;">- Qualité</p></td><td><a href="http://www.ecocompare.com/images/logo-bossaverde-190.png"><img border="0" alt="http://www.bossaverde.com" src="http://www.ecocompare.com/images/logo-bossaverde-190.png"></a></td></tr>
	</tbody></table>
	<br>La toute première version de la méthodologie a été vérifiée en 2009 par l'<span style="font-weight: bold;">ADEME</span>&nbsp;puis à fait l'objet pour 2010-2011 d'un partenariat avec le master S<span style="font-weight: bold;">cience et Génie de l'Environnement de l'Université PARIS VII</span>. En 2012, les ingénieurs de l'entreprise <a href="http://www.bossaverde.com">BOSSA VERDE</a> ont travaillés sur une nouvelle évolution majeure de la méthodologie en intégrant les aspects sociaux, santé, qualité et éthique mais&nbsp;l'analyse et l'intégration d'une&nbsp;centaine&nbsp;de&nbsp;référentiels de labels.<br><p></p>
	<p style="text-align: justify;">Notre méthodologie est complètement transparente, vous trouverez le détail en <a href="/methodologie.html">cliquant sur ce lien</a>.<br>
	</p>
</div>
</br></br><a class="titre" name="smartphone"><img src="style/expand2.png" />&nbsp;<b>A quoi sert l'application smartphone (iPhone &amp; Android) ?</b></a>
<div class="contenu" ><p>Ecocompare vous propose avec votre smartphone de participer à une démarche unique, collaborative de transparence écologique! En effet, les codes barre des produits non encore référencés sur ecocompare, qui seront les plus scannés feront l'objet de la part de l'équipe ecocompare d'une démarche auprès des fabricants. <br>Les eco-acteurs <b>les plus actifs</b> seront également mis à l'honneur et affichés en quasi temps réel sur le site. Vous pouvez dès maintenant <a href="http://www.ecocompare.com/Userlist.html">afficher les résultats</a>.</p><p><br>Installez gratuitement l'application iPhone ecocompare en vous rendant dans l'<a href="http://itunes.apple.com/fr/app/ecocompare/id393539838">apple store</a> ou sur <a href="https://play.google.com/store/apps/details?id=com.ecocompare">google Play</a>.</p></div>

</br></br><a class="titre" name="ecoacteur"><img src="style/expand2.png" />&nbsp;<strong>Comment devenir eco-acteur et quel intéret ?</strong></a>
<div class="contenu" ><p>Nous sommes persuadés que les consommateurs peuvent jouer un rôle très important vis à vos des marques engagées, en les aidant à s'améliorer.&nbsp;Certains consommateurs actifs pourront participer à une démarche collaborative en proposant de nouveaux produits, donnant son avis concernant la perception des produits. Les eco-acteurs les plus actifs seront récompensés à travers des classements et lots à échanger.</p><p>&nbsp;</p><h2 align="center"><em>"les choix que nous faisons, la société que nous souhaitons"</em></h2><h2 align="center"><em></em>&nbsp;</h2></div>

</br></br><a class="titre" name="fabricant"><img src="style/expand2.png" />&nbsp;<span style="font-weight: bold;"><b>Je suis fabricant et j'ai réalisé des efforts sur les aspects environnementaux ou sociaux, comment référencer mes produits ?</b></span></a>
<div class="contenu" ><p><br>Une publication sur Ecocompare apporte de multiples avantages aux fabricants qui commercialisent des produits plus respectueux de l'environnement ou de l'humain.<br></p><ul><li>Démarche de transparence vis à vis des consommateurs  : on explique et justifie tous les efforts mis en œuvre par le fabricant<br></li><li>Aide au référencement : les internautes trouvent plus facilement les produits car ecocompare dispose en tant qu'annuaire des eco-produits, un référencement naturel important sur les moteurs de recherche. Ecocompare arrive dans les premières pages pour de nombreux mots clés. </li><li>Amélioration du trafic : vous pouvez mettre un lien vers la boutique web de votre choix, ce qui augmente le trafic et la visibilité de vos produits plus respectueux de l'environnement</li><li>Notoriété et confiance : un produit évalué sur ecocompare permet de lutter efficacement contre le greenwashing et rassure le consommateur</li></ul><p><br><br>Une publication ecocompare c'est l'assurance d'obtenir un très bon référencement de vos produits plus respectueux de l'environnement et de l'homme ainsiqu qu'une diffusion dans différents médias et réseaux sociaux (Facebook, Twitter, ...). Si vous êtes intéressée en tant que marque, <a href="http://projets2.idnext.net/Contactez-nous.html">contactez-nous</a> ! nous vous ouvrirons un compte gratuitement.</p></div>


</br></br><a  class="titre"name="selection"><img src="style/expand2.png" />&nbsp;<b>Le produit que je propose sur mon site est cité sur ecocompare</b></a>
<div class="contenu" ><p>Lorsqu'un produit&nbsp; est&nbsp;référencé sur ecocompare, c'est qu'il offre de réelles qualités écologiques ou éthiques, quelque soit son score.&nbsp;</p><p>&nbsp;</p><p>Comme notre philosophie est basée sur l'information gratuite du consommateur, nous invitons simplement le site à indiquer que ce produit a été sélectionné par ecocompare en ajoutant notre lien logo :<br><img border="0" alt="selection ecocompare" src="http://www.ecocompare.com/images/selection.jpg">.</p><br>Voici le lien HTML à rajouter à coté de votre produit : <br>&lt;a href="http://www.ecocompare.com"&gt;&lt;img src="http://www.ecocompare.com/images/selection.jpg" alt="selection ecocompare" border="0"&gt;&lt;/a&gt; <br></div>

</br></br><a  class="titre" name="lien"><img src="style/expand2.png" />&nbsp;<b>Je souhaite mettre un lien d'un produit ecocompare vers ma boutique</b></a>
<div class="contenu" ><p style="text-align: justify;">Si vous souhaitez mettre le lien de votre boutique dans la rubrique "ou le trouver", <a href="http://www.ecocompare.com/content/show/Contactez-nous">contactez-nous</a></p></div>

</br></br><a class="titre" name="ecobilan"><img src="style/expand2.png" />&nbsp;<b>Je souhaite obtenir l'écobilan des produits de mon entreprise</b></a>
<div class="contenu" ><p style="text-align: justify;">Bien qu'ecocompare soit un guide des eco-produits dédié au grand public et aux consommateurs, nous travaillons également avec l'entreprise <a href="http://www.bossaverde.com">BOSSA VERDE</a> pour les aider à réaliser un écobilan (ou cycle de vie) de leurs produits. </p></div>

</br></br>

</div>