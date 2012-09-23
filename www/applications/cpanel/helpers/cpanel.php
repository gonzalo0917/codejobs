<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function getCheckbox($ID, $disabled = NULL) {
	return '<input id="records" name="records[]" value="'. $ID .'" type="checkbox" '. $disabled .'/>';	
}

function getAction($trash = FALSE, $ID, $delete = TRUE, $edit = TRUE, $comments = FALSE) {
	global $Load;
	
	$delete = $Load->execute("Users_Model", "isAllow", array("delete"), "model");
	$edit 	= $Load->execute("Users_Model", "isAllow", array("edit"), "model");
	$application = whichApplication();

	if($application === "comments") {
		if($delete and $edit) {				
			$URL1     = path($this->application ."/cpanel/validate/$ID");
			$URL2     = path($this->application ."/cpanel/trash/$ID");
			$title1   = __("Validate comment");
			$title2   = __("Send to trash");
			$onClick1 = "return confirm('". __("Do you want to validate the comment?") ."')";
			$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";			
				
			if($comments) {					
				$action = a(span("tiny-image tiny-ok", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
						  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));
			} else {
				$action = a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));
			}
		} elseif($delete and $edit) {
			$URL1	  = path($application ."/cpanel/read/$ID");
			$URL2 	  = path($application ."/cpanel/trash/$ID");	
			$title1   = __("Read Comment");
			$title2   = __("Send to Trash");				
			$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";	
				
			$action = a(span("tiny-image tiny-mail-off", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));												
		}
	} elseif($application === "feedback") {
		if($delete and $edit) {
			$URL1     = path($application ."/cpanel/read/$ID");
			$URL2     = path($application ."/cpanel/trash/$ID");
			$title1   = __("Read Message");
			$title2   = __("Send to Trash");				
			$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";	
				
			$action = a(span("tiny-image tiny-feedback", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));										
		} elseif($delete and !$edit) {
			$URL1     = path($application ."/cpanel/read/$ID");
			$URL2     = path($application ."/cpanel/trash/$ID");
			$title1   = __("Read Message");
			$title2   = __("Send to Trash");				
			$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";	
				
			$action = a(span("tiny-image tiny-mail-off", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));				
		}	
	} elseif($comments) {
		$URL1     = path($application ."/cpanel/validate/$ID");
		$URL2     = path($application ."/cpanel/trash/$ID");
		$title1   = __("Validate Comment");
		$title2   = __("Send to Trash");
		$onClick1 = "return confirm('". __("Do you want to validate the comment?") ."')";
		$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";	
					
		$action = a(span("tiny-image tiny-ok", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
		  		  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));						 
	} elseif(!$trash) {
		if($delete and $edit) {
			$URL1     = path($application ."/cpanel/edit/$ID");
			$URL2     = path($application ."/cpanel/trash/$ID");
			$title1   = __("Edit");
			$title2   = __("Send to trash");
			$onClick1 = "return confirm('". __("Do you want to edit the record?") ."')";
			$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";
			
			$action = a(span("tiny-image tiny-edit", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));	
		} elseif($delete and !$edit) {  				
			$URL2     = path(application ."/cpanel/trash/$ID");				
			$title2   = __("Send to trash");				
			$onClick2 = "return confirm('". __("Do you want to send to the trash the record?") ."')";
			
			$action = a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));				
		} elseif(!$delete and !$edit) {
			$action = span("tiny-image tiny-edit-off", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") . 
			   		  span("tiny-image tiny-trash-off", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		}
	} else {
		$URL1     = path($application ."/cpanel/restore/$ID");
		$URL2     = path($application ."/cpanel/delete/$ID");
		$title1   = __("Restore");
		$title2   = __("Delete");
		$onClick1 = "return confirm('". __("Do you want to restore the record?") ."')";
		$onClick2 = "return confirm('". __("Do you want to delete the record permanently?") ."')";
		
		$action = a(span("tiny-image tiny-restore", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)). 
		  		  a(span("tiny-image tiny-delete", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));	
	}
	
	return $action;
}

function getSearch() {
	global $Load;
	
	$Load->helper(array("forms", "html"));

	$application = whichApplication();
	
	if($application === "users") {
		$field = "username";
		$name  = __("Username");
	} else {
		$field = "title";
		$name  = __("Title");			
	}
	
	$fields = array(
		0 => array(
				"field"    => "ID",   
				"name"     => "ID",  
				"selected" => FALSE
			), 
		1 => array(
				"field"    => $field, 
				"name"     => $name, 
				"selected" => TRUE
			)
	);

	$trash = NULL;

	if(segment(3, isLang()) === "trash") {
		$trash = "trash";
	}

	$HTML  = formOpen(path($application ."/cpanel/results/$trash"), "form-results-search");
	$HTML .= br();
	$HTML .= bold("&nbsp". __("Search") .":", FALSE);

	$attributes = array(
		"p" 	=> FALSE,
		"name" 	=> "search",
		"class" => "span 1 required"
	);

	$HTML .= formInput($attributes);

	$HTML .= bold(" ". __("Field") .":", FALSE);
	
	$i = 0;		

	foreach($fields as $field) {
		$fields[$i]["value"]    = $field["field"];
		$fields[$i]["option"]   = $field["name"];
		$fields[$i]["selected"] = $field["selected"];
		
		$i++;
	}
	
	$HTML .= formSelect(array("name" => "field", "class" => "span2 required"), $fields);
	
	$HTML .= bold(__("Order") . ":", FALSE);
	
	$options[0]["value"]    = "ASC";
	$options[0]["option"]   = __("Ascending");
	$options[0]["selected"] = TRUE;
	$options[1]["value"]    = "DESC";
	$options[1]["option"]   = __("Descending");
	$options[1]["selected"] = FALSE;
	
	$HTML .= formSelect(array("name" => "order", "class" => "span2 required"), $options);
	$HTML .= formInput(array("name" => "seek", "type" => "submit", "class" => "btn btn-info", "value" => __("Seek")));	
	
	return $HTML;
}

function getSituation($situation, $id) {
	global $Load;

	$edit 		 = $Load->execute("Users_Model", "isAllow", array("edit"), "model");
	$application = whichApplication();

	if($edit) {
		if($situation === "Pending") {
			return "<a href=\"#\" onclick=\"if(confirm('". htmlentities(__("Do you want to activate this publication?")) ."')) { parent = $(this).parent(); link = $(this).detach(); parent.html('". htmlentities(__("Processing")) ."'); $.get('". path("$application/cpanel/activate/$id") ."', function(data) { if(data.return == 1) parent.html('". htmlentities(__("Active")) ."'); else { alert('". htmlentities(__("An error has occurred")) ."'); parent.append(link); } }, 'json') } return false; \">". __($situation) ."</a>";
		} else {
			return __($situation);
		}
	} else {
		return __($situation);
	}
}