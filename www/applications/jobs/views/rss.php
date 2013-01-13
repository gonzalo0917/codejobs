<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); 		

header("Content-Type: application/rss+xml"); 
echo "<?xml version='1.0' encoding='utf-8'?>";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"> 
  <channel> 
    <title><![CDATA[Codejobs - <?php echo __("Jobs") ?> ]]></title> 
    <link><![CDATA[<?php echo path()?>]]></link> 
    <description><![CDATA[RSS Codejobs]]></description>
    <language>es-es</language> 
    <copyright><![CDATA[Codejobs]]></copyright>
    <atom:link href="<?php echo path("jobs/rss"); ?>" rel="self" type="application/rss+xml" />
    

	<image>
		<url> <?php echo path("www/lib/themes/newcodejobs/images/logo.png", TRUE)?></url>

		<title>Codejobs - <?php echo __("Jobs"); ?></title>
		<link><?php echo path()?></link>
	</image>
	<?php 
	if(is_array($jobs)) {	
	
	foreach($jobs as $job) {

		
	?>
			
		<item>
		<title>
		<![CDATA[<?php echo $job["Title"]; ?>]]>
		</title>
		<link>
		<![CDATA[<?php echo path("jobs/". $job["ID_Job"] ."/". $job["Slug"], FALSE, $job["Language"]); ?>]]>
		</link>
		<description>
		<![CDATA[<?php echo $job["Description"]; ?>]]>
		</description>
		<guid isPermaLink="true">
		<![CDATA[]]>
		</guid>
		<author>
		<![CDATA[<?php echo $job["Author"]; ?>]]>
		</author>
		<pubDate>
		<![CDATA[<?php echo $job["Start_Date"]; ?>]]>
		</pubDate>
		</item>
	<?php
		}
	}
	 ?>	
  </channel>

</rss>