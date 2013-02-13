<?php 
<<<<<<< HEAD
if (!defined("ACCESS")) die("Error: You don't have permission to access here...");

=======
if (!defined("ACCESS")) die("Error: You don't have permission to access here..."); 
		
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
if (isset($message)) {
	echo '<div class="error-box">';
	echo '<p class="error-message bold">No existen Comentarios Registrados</p>';
	echo '</div>';
} else {
<<<<<<< HEAD
	echo isset($search) ? $search : null;
	echo isset($table) ? $table : null;
	echo isset($pagination) ? $pagination : null;
}
=======
	echo isset($search) 	 ? $search 	   : null;
	echo isset($table) 	 ? $table 	   : null;
	echo isset($pagination) ? $pagination : null;
}
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
