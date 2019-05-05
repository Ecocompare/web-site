<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>

<rss version="2.0">

<channel>
<title>Articles Ecocompare</title>
<description>Derniers articles sur Ecocompare</description>
<link>http://www.ecocompare.com</link>
<pubDate><?= date("r", time()) ?></pubDate>

<? foreach($this->articles as $key => $article){ ?>
<item>
<title><?=$article['title']?></title>
<description><?=htmlspecialchars(stripslashes(trimText(stripslashes($article['text']), 300)))?></description>
<link><?=$GLOBALS['base']?><?=toURL($article['title'])?>_d<?=$article['id']?>.html</link>
			
<guid isPermaLink="true"><?=$GLOBALS['base']?><?=toURL($article['title'])?>_d<?=$article['id']?>.html</guid>


	
<pubDate><?= date("r", $article['created']) ?></pubDate>
</item>

<? } ?>

</channel>

</rss>