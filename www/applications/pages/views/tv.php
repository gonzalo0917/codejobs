<?php
	$path = path("www/applications/pages/views/", TRUE);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Codejobs TV!</title>
		
		<link rel="stylesheet" href="http://www.codejobs.biz/web/www/lib/css/default.css" type="text/css">
		<link rel="stylesheet" href="<?php echo path("www/applications/pages/views/css/style.css", TRUE); ?>" type="text/css">

		<style>
			.videos {
				width: 900px;
				margin: 0 auto;
				text-align: center;
			}

			.ads {
				text-align:center; 
				width: 900px;
				margin: 0 auto;
			}
		</style>
	</head>

	<body>	
		<header>
			<div id="logo" style="width: 290px; margin: 0 auto; background-repeat: no-repeat;">
				<a href="http://www.codejobs.biz"><img src="<?=$path; ?>/images/logo.png" border="0" /></a>
			</div>
		</header>
		
		<div id="content">
			<?php
				echo $tv;

				if($chat) {
			?>
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://macromedia.com/cabs/swflash.cab#version=6,0,0,0" width="250" height="420">
				  <param name="movie" value="http://cdn.livestream.com/chat/LivestreamChat.swf">
				  <param name="flashvars" value="channel=codejobs">
				  <param name="quality" value="medium">
				  <param name="bgcolor" value="#FFFFFF">
				  <embed src="http://cdn.livestream.com/chat/LivestreamChat.swf" flashvars="channel=codejobs" bgcolor="#FFFFFF" width="250" height="420" type="application/x-shockwave-flash">
				  </embed>
				</object>
			<?php
				}
			?>
						
			<div class="ads">
				<script type="text/javascript"><!--
				google_ad_client = "ca-pub-4006994369722584";
				/* CodeJobs */
				google_ad_slot = "0632542362";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>				
			</div>
		</div>    
        
		<div class="sponsors" style="text-align: center; margin-top: 0px;">
			<div style="width: 400px; margin: 0 auto;"><a rel="nofollow" href="http://vincoorbis.com/unete-al-equipo/" target="_blank"><img src="<?=$path; ?>/images/patrocinadores/vacantes.gif" /></a></div>
			<a rel="nofollow" href="http://www.milkzoft.com" target="_blank" title="MilkZoft"><img src="<?=$path; ?>/images/patrocinadores/MilkZoft.png" width="100" height="31" /></a>			
			<a rel="nofollow" href="http://www.vangtel.com" target="_blank" title="Vangtel"><img src="<?=$path; ?>/images/patrocinadores/vangtel.png" width="100" height="31" /></a>
			<a rel="nofollow" target="_blank" href="http://www.crowdint.com/"><img src="<?php echo path("www/applications/pages/views/images/patrocinadores/crowd_small.png", TRUE); ?>" alt="Crowd Int" /></a>			
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a><br />
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a><br />
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a><br />
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
			<a rel="nofollow" href="patrocinio.html" target="_blank" title="Comprar espacio"><img src="<?=$path; ?>/images/buy15.png" width="100" height="31" /></a>
		</div>

		<!-- Start of StatCounter Code for Default Guide -->
		<script type="text/javascript">
			var sc_project = 7655788; 
			var sc_invisible = 1; 
			var sc_security = "f167f55b"; 
		</script>

		<script type="text/javascript" src="http://www.statcounter.com/counter/counter.js"></script>
		<!-- End of StatCounter Code for Default Guide -->
    </body>
</html>