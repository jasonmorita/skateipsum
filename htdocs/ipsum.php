<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/db.php');

?>

<header>
	<h1>Skate Ipsum.</h1>
	<nav>
		<a title="get">Ipsum</a>
		<a title="api">API</a>
		<a title="plugin">jQuery</a>
		<a title="why">Why</a>
		<a href="https://github.com/jasonmorita/skateipsum">GitHub</a>
	</nav>
</header>
 
<div role="main">
	<div id="get" class="content">
		<h1>Get Skate Ipsum.</h1>
		<form id="getForm" method="post" action="javascript:getIpsum();">
			Land  
			<select id="paragraphs" name="paragraphs">
				<?php
					for ($i=1; $i<=20; $i++)
					{
						echo '<option value="'.$i.'"';
						if ($i==3) { echo ' selected'; }
						echo '>'.$i.'</option>';
					}
				?>
			</select> paragraphs.
			<br><br>
			<input type="checkbox" id="startWith" name="startWith" value="1" checked="checked"> 
			<label for="startWith">Drop in with 'Skate ipsum dolor sit amet'</label>
			<br><br>
			Choose your stance: 
			<ul>
				<li>
					<input type="radio" id="opText" name="output" value="text" checked="checked"><label for="opText"> text</label>
				</li>
				<li>
					<input type="radio" id="opHtml" name="output" value="HTML"><label for="opHtml"> HTML (&lt;P&gt;s)</label>
				</li>
				<li>
					<input type="radio" id="opJson" name="output" value="JSON"><label for="opJson"> JSON</label>
				</li>
			</ul>	
			<input type="submit" value="Shred!">
		</form>
		<a name="ipsum"></a>
		<div id="ipsum" style="margin: 20px 0;"></div>
	</div>
	
	<div id="api" class="content secondary">
		<h1>
			REST API Usage
		</h1>
		<ul>
			<li>
				JSON:
				<br>
				<a href="http://skateipsum.com/get/3/1/JSON" target="_blank">http://skateipsum.com/get/3/1/JSON</a>
			</li>
			<li>
				Text:
				<br>
				<a href="http://skateipsum.com/get/3/1/text" target="_blank">http://skateipsum.com/get/3/1/text</a>
			</li>
			<li>
				HTML:
				<br>
				<a href="http://skateipsum.com/get/3/1/HTML" target="_blank">http://skateipsum.com/get/3/1/HTML</a>
			</li>
		</ul>
		<div>
			URL scheme in example:
			<br>
			3 = Number of paragraphs.
			<br>
			1 = Start with 'Skate ipsum dolor sit amet' (0 starts without it).
			<br>
			JSON/text/HTML = Format of ipsum. Case-sensitive.
		</div>		
	</div>
	
	<div id="plugin" class="content secondary">
		<h1>jQuery Plugin Action</h1>
		<div>
			<ul>
				<li>
					$('#target').SK8Ipsum();
					<br>
					Default is 3 paragraphs and start with 'Skate ipsum dolor sit amet'.
				</li>
				<li>
					$('#target').SK8Ipsum({ paragraphs: 5, startWith: 0 } );
					<br>
					Options described above in REST description.
				</li>
				<li>
					<a href="http://skateipsum.com/js/jquery-SK8Ipsum.js" target="_blank">http://skateipsum.com/js/jquery-SK8Ipsum.js</a>
				</li>
			</ul>
		</div>
	</div>
	
	<div id="why" class="content secondary">
		<h1>Why?</h1>
		<div>
			I thought it would be fun. 
			<br><br>
			A couple of friends and I were talking about skateboards and somewhere in the middle of the conversation <a href="http://baconipsum.com/" target="_blank">Bacon Ipsum</a> came up. 
			<br><br>
			Voila!
		</div>
		
		<h1>What is it though?</h1>
		<div>
			<a href="https://en.wikipedia.org/wiki/Lorem_ipsum" target="_blank">This</a> will explain it.
		</div>
	</div>
	
	
</div>

<?php
try {
	$stmt = $db->prepare("select sum(paragraphs) as landed from served");
	$stmt->execute();
	$landed = $stmt->fetchAll();
}
catch (Exception $e) {
	die($e->errorInfo[2]);
}
?>

<footer>
	<p>
	<small>Made April 2012 by <a href="https://twitter.com/jasonmorita" target="_blank">Jason Morita</a> with lots of text input by <a href="https://twitter.com/ixdarren" target="_blank">Darren Ellis</a> and <a href="http://johnminardi.com/" target="_blank">John Minardi</a>. <a href="mailto:jason@hescoding.com?subject=SK8IPSUM">Let me know</a> if you find a problem, have a suggestion or think something is missing (a lot is). <?php echo number_format($landed[0][0], 0, '', ','); ?> paragraphs landed in a row.</small>
	</p>
	<div class="clearfix" style="text-align: left;">
		<div style="float: left;">
			<a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fskateipsum.com%2F&media=http%3A%2F%2Fskateipsum.com%2Fimg%2Fskateipsum.png&description=A%20gnarly%20skate%20lorem%20ipsum%20generator.%20" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
		</div>
		<div style="float: left;" data-href="http://skateipsum.com/" class="fb-like" data-send="false" data-layout="standard" data-width="120" data-show-faces="false" data-action="like" data-colorscheme="light"></div>
		<div style="float: left;">
			<!-- Place this tag where you want the +1 button to render -->
			<g:plusone size="medium" annotation="inline" width="120" href="http://skateipsum.com/"></g:plusone>
			
			<!-- Place this render call where appropriate -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>		
		</div>
	</div>
</footer>
<div id="pimage"><img src="/img/skateipsum.png"></div>