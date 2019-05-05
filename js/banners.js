<script>
banners = new Array();

banners[0] = '<a href="http://terresacree.org" target="_blank"><img src="http://terresacree.org/images/014.gif" border="0" alt="Base vivante d&#8217;nformations environnementales, d&#8217;alerte et de reflexion"></a>';

banners[1] = '<a href="http://terresacree.org" target="_blank"> <img src="http://terresacree.org/images/013.gif" border="0" alt=""></a>';

rand = Math.floor(Math.random() * banners.length);
document.write(banners[rand]);
</script>