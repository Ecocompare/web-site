<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>

<rss version="2.0">

<channel>
<title>Produits écologiques évalués par Ecocompare</title>
<description>Derniers tests produits sur Ecocompare</description>
<link>http://www.ecocompare.com</link>
<pubDate><?= date("r", time()) ?></pubDate>

<? foreach($this->products as $key => $product){ ?>
<item>
<title><![CDATA[<?=$product['name']?>]]></title>
<description><?=htmlspecialchars(stripslashes(trimText(stripslashes($product['description']), 300)))?></description>
<link><?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html</link>
<guid isPermaLink="true"><?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html</guid>


	
<pubDate><?= date("r", $product['pubdate']) ?></pubDate>
</item>

<? } ?>

</channel>

</rss>