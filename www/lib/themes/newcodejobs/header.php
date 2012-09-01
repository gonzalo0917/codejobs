<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>
<!DOCTYPE html>
<html lang="<?php echo get("webLang"); ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php echo $this->getMeta(); ?>
	<title><?php echo $this->getTitle(); ?></title>
	<link href="<?php echo path("blog/rss"); ?>" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Blog"); ?>" />
	<link href="<?php echo path("bookmarks/rss"); ?>" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Bookmarks"); ?>" >
	<link href="http://gdata.youtube.com/feeds/api/users/codejobs/uploads" rel="alternate" type="application/rss+xml" title="RSS <?php echo __("Videos"); ?>" >
	<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo path("www/lib/css/default.css", TRUE); ?>" type="text/css">
	<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/mediaqueries.css" type="text/css">
	
	<?php 
		echo $this->getCSS(); 
	 	
	 	echo $this->js("jquery", NULL, TRUE); 
	 	echo $this->js("jquery.dataset.js", NULL, TRUE); 
                
        if(defined("_codemirror")) {
            print $this->js("codemirror", NULL, TRUE);
        }
        
	 ?>

	<script type="text/javascript" src="<?php echo $this->themePath; ?>/js/social.js"></script>

	<script type="text/javascript" src="<?php echo $this->themePath; ?>/js/porlets.js"></script>
        
    <script type="text/javascript">
		var PATH = "<?php print path(); ?>";
		
		var URL  = "<?php print get('webURL'); ?>";
	</script>
</head>

<?php $locale = getLocal(); ?>

<body>	
	<header>
		<div id="fb-root"></div> 
		<script type="text/javascript">
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];

                if(d.getElementById(id)) return;

                js = d.createElement(s); 
                js.id = id;
                js.src = "//connect.facebook.net/<?php echo $locale; ?>/all.js#xfbml=1&appId=323728064351205";

                fjs.parentNode.insertBefore(js, fjs);
            } (document, 'script', 'facebook-jssdk'));
		</script>
		<div id="topbar-wrapper">
			<div id="topbar">
				<nav>
					<ul>
						<li><a href="<?php echo path(); ?>"><?php echo __("Home"); ?></a></li>
						<!--<li><a href="<?php echo path("codes"); ?>"><?php echo __("Codes"); ?></a></li>-->
						<!--<li><a href="<?php echo path("jobs"); ?>"><?php echo __("Jobs"); ?></a></li>-->
						<!--<li><a href="<?php echo path("forums"); ?>"><?php echo __("Forums"); ?></a></li>-->
						<li><a href="http://www.youtube.com/codejobs" target="_blank"><?php echo __("Videos"); ?></a></li>
						<li><a href="<?php echo path("bookmarks"); ?>"><?php echo __("Bookmarks"); ?></a></li>
					</ul>
				</nav>

				<div id="top-box-languages" class="toggle">
					<a href="<?php echo path("es"); ?>" title="<?php echo __("Spanish"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/es.png" alt="Spanish" class="noborder" /></a>
					<a href="<?php echo path("en"); ?>" title="<?php echo __("English"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/en.png" alt="English" class="noborder" /></a>
					<a href="<?php echo path("fr"); ?>" title="<?php echo __("French"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/fr.png" alt="French" class="noborder" /></a>
					<a href="<?php echo path("pt"); ?>" title="<?php echo __("Portuguese"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/pt.png" alt="Portuguese" class="noborder" /></a>
					<a href="<?php echo path("it"); ?>" title="<?php echo __("Italian"); ?>"><img src="<?php echo $this->themePath; ?>/images/flags/it.png" alt="Italian" class="noborder" /></a>
				</div>

				<div id="top-box-register" class="toggle">
					<span class="bold"><?php echo __("Are you new on CodeJobs?, Register!"); ?></span><br />

					<form action="<?php echo path("users/register"); ?>" method="post" class="form-register">
						<fieldset>
							<input id="register-name" name="name" class="register-input" type="text" required placeholder="<?php echo __("Full Name"); ?>" /> <br />
							<input id="register-email" name="email" class="register-input" type="email" required placeholder="Email" /> <br />
							<input id="register-password" name="password" class="register-input" type="password" required placeholder="<?php echo __("Password"); ?>" /> <br />
							<input name="register" class="register-submit" type="submit" value="<?php echo __("Register on CodeJobs!"); ?>" />
						</fieldset>
					</form>
				</div>

				<div id="top-box-login" class="toggle">
					<span class="bold"><?php echo __("Do you Have an account?, Login!"); ?></span><br />

					<form action="<?php echo path("users/login"); ?>" method="post" class="form-login">
						<fieldset>
							<input id="login-username" name="username" class="login-input" type="text" required placeholder="<?php echo __("Username or Email"); ?>" /> <br />
							<input id="login-password" name="password" class="login-input" type="password" required placeholder="<?php echo __("Password"); ?>" /> 
							<br />
							<a href="<?php echo path("users/recover"); ?>"><?php echo __("Forgot your password?"); ?></a>

							<input name="login" class="login-submit" type="submit" value="<?php echo __("Login"); ?>" />
						</fieldset>
					</form>
				</div>

				<div id="top-box-profile" class="toggle">
					<div class="top-box-profile">
						<div style="float: left; width: 90px;">
							<img src="<?php echo path("www/lib/files/images/users/". SESSION("ZanUserAvatar"), TRUE); ?>" alt="<?php echo SESSION("ZanUser"); ?>" />
						</div>

						<div style="float: left; width: 170px; line-height: 15px;">
							<span class="bold"><?php echo SESSION("ZanUserName"); ?></span> <br />
							<span class="small grey"><a href="#"><?php echo __("See my profile page"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>
							
							<span class="small grey"><a href="#"><?php echo __("Direct Messages"); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __("Help"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><strong><?php echo __("My codes"); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __("My jobs"); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __("My posts"); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __("My courses"); ?></strong>: <a href="#">0</a></span><br />
							<span class="small grey"><strong><?php echo __("My points"); ?></strong>: 0</span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="<?php echo path("codes/add"); ?>"><?php echo __("Publish a code"); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __("Publish a job"); ?></a></span><br />
							<span class="small grey bold"><a href="<?php echo path("bookmarks/add"); ?>"><?php echo __("Publish a bookmark"); ?></a></span><br />
							<span class="small grey"><a href="#"><?php echo __("Publish a post"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<span class="small grey"><a href="#"><?php echo __("Update my Resume"); ?></a></span><br />

							<div style="width: 170px; border-top: 1px dotted #CCC; margin-top: 5px; margin-bottom: 5px;"></div>

							<?php
								if(SESSION("ZanUserPrivilegeID") <= 2) {
								?>
									<span class="small grey"><a href="<?php echo path("cpanel"); ?>"><?php echo __("Go to CPanel"); ?></a></span><br />
								<?php
								}
							?>

							<span class="small grey"><a href="<?php echo path("users/logout"); ?>"><?php echo __("Logout"); ?></a></span><br />
						</div>

						<div class="clear"></div>
					</div>
				</div>

				<div id="top-box">
					<ul>
						<?php
							if(!SESSION("ZanUser")) {
						?>
								<li class="float-right">
									<a id="display-login" href="#" title="<?php echo __("Login"); ?>">
										<?php echo __("Login"); ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" class="noborder" />
									</a>
								</li>
								
								<li class="float-right">
									<a id="display-register" href="#" title="<?php echo __("Register!"); ?>">
										<?php echo __("Register!"); ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" class="noborder" />
									</a>
								</li>
						<?php
							} else {
						?>
								<li class="float-right">
									<a id="display-profile" href="#" title="<?php echo __("Hi"); ?>">
										<?php echo __("Hi") .', <span style="color: #00a0ff">'. SESSION("ZanUser") .'</span>'; ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" class="noborder" />
									</a>
								</li>
						<?php
							}
						?>
						
						<li class="float-right">
							<a id="display-languages" href="#" title="<?php echo __("Language"); ?>">
								<?php echo getLanguage(whichLanguage(), TRUE); ?> <?php echo __("Language"); ?> <img src="<?php echo $this->themePath; ?>/images/arrow-down.png" class="noborder" />
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="clear"></div>
		</div>

		<div id="wrapper">
			<div id="logo">
				<a href="<?php echo path(); ?>"><img src="<?php echo path("www/lib/themes/newcodejobs/images/logo.png", TRUE); ?>" alt="CodeJobs" class="noborder" /></a>
			</div>

			<?php
				if(segment(0, isLang()) === "bookmarks") {
					$application = "bookmarks";
				} else {
					$application = "blog";
				}
			?>
			<nav>
				<ul>
					<li><a href="<?php echo path("$application/tag/ajax"); ?>">Ajax</a></li>
					<li><a href="<?php echo path("$application/tag/android"); ?>">Android</a></li>
					<li><a href="<?php echo path("$application/tag/backbone"); ?>">Backbone.js</a></li>
					<li><a href="<?php echo path("$application/tag/codeigniter"); ?>">CodeIgniter</a></li>
					<li><a href="<?php echo path("$application/tag/css3"); ?>">CSS3</a></li>
					<li><a href="<?php echo path("$application/tag/databases"); ?>">Databases</a></li>
					<li><a href="<?php echo path("$application/tag/emarketing"); ?>">eMarketing</a></li>
					<li><a href="<?php echo path("$application/tag/git"); ?>">Git &amp; Github</a></li>
					<li><a href="<?php echo path("$application/tag/html5"); ?>">HTML5</a></li>
					<li><a href="<?php echo path("$application/tag/ios"); ?>">iOS</a></li>
					<li><a href="<?php echo path("$application/tag/java"); ?>">Java</a></li>
					<li><a href="<?php echo path("$application/tag/javascript"); ?>">Javascript</a></li>
					<li><a href="<?php echo path("$application/tag/jquery"); ?>">jQuery</a></li>
					<li><a href="<?php echo path("$application/tag/mongodb"); ?>">MongoDB</a></li>
					<li><a href="<?php echo path("$application/tag/mysql"); ?>">MySQL</a></li>
					<li><a href="<?php echo path("$application/tag/nodejs"); ?>">Node.js</a></li>
					<li><a href="<?php echo path("$application/tag/php"); ?>">PHP</a></li>
					<li><a href="<?php echo path("$application/tag/python"); ?>">Python</a></li>
					<li><a href="<?php echo path("$application/tag/ruby"); ?>">Ruby</a></li>
					<li><a href="<?php echo path("$application/tag/ror"); ?>">RoR</a></li>
					<li><a href="<?php echo path("$application/tag/social-media"); ?>">Social Media</a></li>		
					<li><a href="<?php echo path("$application/tag/zanphp"); ?>">ZanPHP</a></li>
				</ul>
			</nav>
		</div>
	</header>
