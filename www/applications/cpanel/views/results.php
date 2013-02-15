<?php

if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

if (isset($message)) {
	echo '<div class="error-box">';
	echo '<p class="error-message bold">No existen Comentarios Registrados</p>';
	echo '</div>';
} else {
	echo isset($search) ? $search : null;
	echo isset($table) ? $table : null;
	echo isset($pagination) ? $pagination : null;
}
