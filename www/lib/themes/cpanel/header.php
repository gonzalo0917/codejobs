<?php if(!defined("_access")) { die("Error: You don't have permission to access here..."); } ?>
<!DOCTYPE html>
<html lang="<?php echo get("webLang"); ?>"<?php echo defined("_angularjs") ? " ng-app" : "";?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->getTitle(); ?></title>
	
	<?php
		$application = segment(0, isLang());

    	$this->CSS("bootstrap", NULL, TRUE);
		$this->CSS("prettyPhoto", "videos"); 
		$this->CSS("ads", "ads"); 
		$this->CSS("default"); 
	
	 	echo $this->getCSS();
		echo $this->themeCSS("cpanel"); 
                
        if(defined("_angularjs")) {
            echo $this->js("angular", NULL, TRUE);
        }
        
        if(defined("_codemirror")) {
            echo $this->js("codemirror", NULL, TRUE);
        }
                
		$this->js("www/lib/scripts/js/main.js");
	?>

	<script type="text/javascript" src="<?php echo path("vendors/js/jquery/jquery.js", "zan"); ?>"></script>

	<?php
		if($application !== "codes" and $application !== "blog") {
	?>
			<script type="text/javascript" src="<?php echo path("vendors/js/editors/markitup/jquery.markitup.js", "zan"); ?>"></script>
			<script type="text/javascript" src="<?php echo path("vendors/js/editors/markitup/sets/html/set.js", "zan"); ?>"></script>

			<link rel="stylesheet" type="text/css" href="<?php echo path("vendors/js/editors/markitup/skins/markitup/style.css", "zan"); ?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo path("vendors/js/editors/markitup/sets/html/style.css", "zan"); ?>" />
	<?php
		}
	?>
	
	<script type="text/javascript">
		var PATH = "<?php echo path(); ?>";
		
		var URL  = "<?php echo get('webURL'); ?>";
	<?php
		if ($application !== "codes" and $application !== "blog") {
	?>
			$(document).on("ready", function() {
	      		$("textarea").markItUp(mySettings);
	   		});
	<?php
		}
	?>
	</script>			
</head>

<body>
	<?php
		if($isAdmin) {
		?>
			<div id="top-bar">
				<?php
					$li[] = a("&lsaquo;&lsaquo;". __("Go back"), path());
					$li[] = " | ". span("bold", __("Welcome")) .": " . SESSION("ZanUser");
					$li[] = " | ". span("bold", __("Online users")) .": $online";
					$li[] = " | ". span("bold", __("Registered users")) .": $registered";
					$li[] = " | ". span("bold", __("Last user")) .": ". a($lastUser["Username"], path("users/". $lastUser["Username"] .""));
					$li[] = " | ". a(__("Logout") ."&rsaquo;&rsaquo;", path("cpanel/logout/")) ."";			
					
					echo ul($li);				
				?>
			</div>
		<?php
		} else {
		?>
			<div id="top-bar-logout">
				<a href="<?php echo path(); ?>" title="<?php echo __("Go back"); ?>">&lsaquo;&lsaquo; <?php echo __("Go back"); ?></a>
			</div>
		<?php		
		}
	?>
	
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="<?php echo path("cpanel"); ?>" title="">
					<img src="<?php echo $this->themePath; ?>/images/logo.png" alt="MuuCMS" class="no-border" />
				</a>
			</div>
						
			<?php
				if($isAdmin) {
				?>
					<div id="background">
						<div id="notifications">
							<?php 								
								if($feedbackNotifications > 0) {
									echo '	<a href="'. path("feedback/cpanel/results") .'" title="'. __("Messages") .'">
												<img src="'. $this->themePath .'/images/icons/feedback.png" alt="'. __("Feedback") .'" class="no-border" /> 
												<sup>'. $feedbackNotifications .'</sup> 
											</a>';
								}
							?>
						</div>
					</div>
					
					<div id="route">
						<strong><?php echo __("You are in"); ?>:</strong> <?php echo routePath(); ?>
					</div>
				<?php
				} else {
				?>
					<br />
				<?php
				}
			?>
		</div>