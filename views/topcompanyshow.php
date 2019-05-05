  <script type="text/javascript">
      window.onload = function() {
        try {
          TagCanvas.Start('myCanvas','tag2s',{
            textColour: '#71C146',
            outlineColour: '#606060',
            reverse: true,
            depth: 0.8,
            maxSpeed: 0.05
          });
        } catch(e) {
          // something went wrong, hide the canvas container
          document.getElementById('myCanvasContainer').style.display = 'none';
        }
      };
    </script>
    
<div>
<h1>Marques les plus scannées (*)</h1>
  <div id="myCanvasContainer">
      <canvas width="600" height="300" id="myCanvas">
        <p>Anything in here will be replaced on browsers that support the canvas element</p>
      </canvas>
    </div>
    <div id="tags">
      <ul>
      	<? foreach($this->brands as $key=>$brand) { ?>
        	<li><a href="#"><?=$brand['marque']?></a></li>
      	<? } ?>
        
      </ul>
    </div>

<br/>(*) pour les produits présentant un label environnemental, sociétal ou noté sur ecocompare<br/><br/>

</div>