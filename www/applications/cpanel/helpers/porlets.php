<?php
<<<<<<< HEAD
=======
/**
 * Access from index.php:
 */
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

<<<<<<< HEAD
function porlet($porlet, $content)
{
	$skin = path("www/lib/themes/cpanel", true);
=======
function porlet($porlet, $content) {
	$skin = path("www/lib/themes/cpanel", true);
	
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
	$HTML  = '	<div class="box">
					&nbsp; <span class="bold grey">'. $porlet .'</span> <span class="float-right bold small grey">X</span>';

				if (is_array($content)) {
<<<<<<< HEAD
					$HTML .= char("\t", 4) . openUl() . char("\n");
=======
					$HTML .= char("\t", 4) . openUl() . char("\n"); 
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
					
					foreach ($content as $list) {
						$HTML .= char("\t", 5) . $list . char("\n");
					}
					$HTML .= char("\t", 4) . closeUl() . char("\n");
				} else { 
					$HTML .= char("\t", 4) . $content . char("\n");
				}

	$HTML .= '</div><br />';
	return $HTML;
}