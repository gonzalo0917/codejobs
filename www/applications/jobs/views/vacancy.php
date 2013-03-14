<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<div class = "results">
	<?php if ($vacancy == ""){
		echo __("You don't have any vacancy");
	} else {
		echo '<caption class="caption">';
		echo '<span class="bold">'. __("List of Vacancy") .'</span></caption>';
		echo '<table class="results">';
		echo '<tr>';
		echo '<th>'. __("Job Name") .'</th>';
		echo '<th>'. __("Vacancy") .'</th>';
		echo '<th>'. __("Cv") .'</th>';
		echo '<th>'. __("Email") .'</th>';
		echo '<th>'. __("Message") .'</th>';
		echo '</tr>';
	
	  foreach ($vacancy as $vacant) {
			echo '<tr>';
			echo '<td>'. $vacant["Job_Name"] .'</td>';
			echo '<td>'. $vacant["Vacancy"] .'</td>';
			echo '<td> Empty </td>';
			echo '<td>'. $vacant["Vacancy_Email"] .'</td>';
			echo '<td>'. $vacant["Message"] .'</td>';
			echo '</tr>';
		} 
	}?>
	</table>
</div>