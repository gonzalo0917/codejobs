<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}
?>
<?php if (!SESSION("ZanUser")) {
				echo '<span class="small italic grey">';
			    echo __("You must be registered to display this content").'</br/>';
				echo "<a title=" .__("Sign Up"). " href=" .path("users/register"). ">". __("Sign Up"). 
					"</a> ". __("or"). " <a title=" .__("Login"). " href=" .path("users/login"). ">" .__("Login"). "</a></span>";
			} else { ?>
<div class = "myjobs">
	<?php if ($myjobs == ""){
		echo __("You don't have any job");
	} else {
		echo '<table class="results">';
		echo '<caption class="caption">';
		echo '<span class="bold">'. __("List of Jobs") .'</span></caption>';
		echo '<tr>';
		echo '<th>'. __("Company") .'</th>';
		echo '<th>'. __("Title") .'</th>';
		echo '<th>'. __("Country") .'</th>';
		echo '<th>'. __("Language") .'</th>';
		echo '<th>'. __("Situation") .'</th>';
		echo '<th>'. __("Action") .'</th>';
		echo '</tr>';
	
	  foreach ($myjobs as $job) {
			echo '<tr>';
			echo '<td>'. $job["Company"] .'</td>';
			echo '<td>'. $job["Title"] .'</td>';
			echo '<td>'. $job["Country"] .'</td>';
			echo '<td>'. getLanguage($job["Language"], true) .'</td>';
			echo '<td>'. $job["Situation"] .'</td>';
			echo '<td><a title="'. __("Edit") .'" href="'. path("jobs/edit/". $job["ID_Job"]) .'">'.__("Edit") .'</a> <a title="'. __("Delete") .'" href="'. path("jobs/delete/". $job["ID_Job"]) .'">'. __("Delete") . '</a></td>'; 
			echo '</tr>';
		}
	}
		}?>
	</table>
</div>