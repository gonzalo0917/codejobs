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
			$title1   = __(_("Validate comment"));
			$title2   = __(_("Send to trash"));
			$onClick1 = "return confirm('". __(_("Do you want to validate the comment?")) ."')";
			$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";			
				
			if($comments) {					
				$action = a(span("tiny-image tiny-ok", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
						  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));
			} else {
				$action = a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));
			}
		} elseif($delete and $edit) {
			$URL1	  = path($application ."/cpanel/read/$ID");
			$URL2 	  = path($application ."/cpanel/trash/$ID");	
			$title1   = __(_("Read Comment"));
			$title2   = __(_("Send to Trash"));				
			$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";	
				
			$action = a(span("tiny-image tiny-mail-off", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));												
		}
	} elseif($application === "feedback") {
		if($delete and $edit) {
			$URL1     = path($application ."/cpanel/read/$ID");
			$URL2     = path($application ."/cpanel/trash/$ID");
			$title1   = __(_("Read Message"));
			$title2   = __(_("Send to Trash"));				
			$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";	
				
			$action = a(span("tiny-image tiny-mail", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));										
		} elseif($delete and !$edit) {
			$URL1     = path($application ."/cpanel/read/$ID");
			$URL2     = path($application ."/cpanel/trash/$ID");
			$title1   = __(_("Read Message"));
			$title2   = __(_("Send to Trash"));				
			$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";	
				
			$action = a(span("tiny-image tiny-mail-off", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));				
		}	
	} elseif($comments) {
		$URL1     = path($application ."/cpanel/validate/$ID");
		$URL2     = path($application ."/cpanel/trash/$ID");
		$title1   = __(_("Validate Comment"));
		$title2   = __(_("Send to Trash"));
		$onClick1 = "return confirm('". __(_("Do you want to validate the comment?")) ."')";
		$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";	
					
		$action = a(span("tiny-image tiny-ok", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
		  		  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));						 
	} elseif(!$trash) {
		if($delete and $edit) {
			$URL1     = path($application ."/cpanel/edit/$ID");
			$URL2     = path($application ."/cpanel/trash/$ID");
			$title1   = __(_("Edit"));
			$title2   = __(_("Send to trash"));
			$onClick1 = "return confirm('". __(_("Do you want to edit the record?")) ."')";
			$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";
			
			$action = a(span("tiny-image tiny-edit", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)) . 
					  a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));	
		} elseif($delete and !$edit) {  				
			$URL2     = path(application ."/cpanel/trash/$ID");				
			$title2   = __(_("Send to trash"));				
			$onClick2 = "return confirm('". __(_("Do you want to send to the trash the record?")) ."')";
			
			$action = a(span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));				
		} elseif(!$delete and !$edit) {
			$action = span("tiny-image tiny-edit-off", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") . 
			   		  span("tiny-image tiny-trash-off", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		}
	} else {
		$URL1     = path($application ."/cpanel/restore/$ID");
		$URL2     = path($application ."/cpanel/delete/$ID");
		$title1   = __(_("Restore"));
		$title2   = __(_("Delete"));
		$onClick1 = "return confirm('". __(_("Do you want to restore the record?")) ."')";
		$onClick2 = "return confirm('". __(_("Do you want to delete the record permanently?")) ."')";
		
		$action = a(span("tiny-image tiny-restore", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL1, FALSE, array("title" => $title1, "onclick" => $onClick1)). 
		  		  a(span("tiny-image tiny-delete", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"), $URL2, FALSE, array("title" => $title2, "onclick" => $onClick2));	
	}
	
	return $action;
}

function getTFoot($trash) {
	global $Load;
	
	$CPanel_Model = $Load->model("CPanel_Model");
	
	$application = whichApplication();
	
	if($application) {
		$colors[0] = _color1;
		$colors[1] = _color2;
		$colors[2] = _color3;
		$colors[3] = _color4;
		$colors[4] = _color5;		

		$i = 0;
		$a = 0;
		$j = 2;		
	}	
	
	$data  = $CPanel_Model->records($trash);
	
	$tFoot = array();
	
	if($data) {		
		foreach($data as $record) {			
			if($record["Situation"] === "Deleted") {
				$color  = $colors[$j];
			} else {
				$color  = $colors[$i];
			}		

			if($application === "ads") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Ad"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Ad"]);
				}

				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Ad"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Ad"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title",     $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Position",  $record["Position"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Banner", 	  $record["Banner"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Principal", $record["Principal"], 	  	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);
			} elseif($application === "applications") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Application"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Application"]);
				}

				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Application"]), $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		      $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Application"],      	  	  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title",     $record["Title"], 	  	  		      $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "CPanel",    $record["CPanel"], 	  	  			  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Adding",    $record["Adding"], 	  	  			  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "BeDefault", $record["BeDefault"], 	  	  		  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Comments",  $record["Comments"], 	  	              $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Category",  $record["Category"], 	  	              $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			  $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			  $tFoot);
			} elseif($application === "blog") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Post"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Post"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Post"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Post"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Author", 	  $record["Author"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Language",  $record["Language"],    	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);	
			} elseif($application === "pages") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Page"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Page"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Page"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Page"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Language",  $record["Language"],    	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Principal", $record["Principal"],   	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);	
			} elseif($application === "links") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Link"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Link"]);
				}	
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Link"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Link"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "URL",       $record["URL"],    	      		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Category",  $record["Position"],   	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  		$tFoot);	
			} elseif($application === "videos") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Video"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Video"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",   getCheckbox($record["ID_Video"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		   $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		   $record["ID_Video"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	   $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID_YouTube", $record["ID_YouTube"],    	      	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",     $action, 			      	  		$tFoot);	
			} elseif($application === "feedback") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Feedback"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Feedback"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Feedback"]),	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Feedback"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Name", 	  $record["Name"], 	  	      			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Email",     $record["Email"],    	      			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Subject",   $record["Subject"],    	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Text_Date", $record["Text_Date"],    	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  		  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);	
			} elseif($application === "gallery") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Image"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Image"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Image"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Image"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Album",     $record["Album"],    	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Image",     _webURL . _sh . $record["Original"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	   			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);	
			} elseif($application === "polls") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Poll"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Poll"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Poll"]), 	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  		 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Poll"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Type",      $record["Type"],    	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);	
			} elseif($application === "users") {
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Post"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Post"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_User"]), 	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_User"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Username",  $record["Username"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Email", 	  $record["Email"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);
			} elseif($application === "works") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Work"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Work"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  getCheckbox($record["ID_Work"]), 	    $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  $color, 					  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  $record["ID_Work"], 	      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title",     $record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Preview",   _webURL . _sh . $record["Image"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Preview1",  _webURL . _sh . $record["Preview1"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Preview2",  _webURL . _sh . $record["Preview2"], 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", $record["Situation"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    $action, 			      	  			$tFoot);
			} elseif($application === "comments") {
				$Applications_Model = $Load->model("Applications_Model");
				$Application = $Applications_Model->getApplication($record["ID_Application"]);
				
				$Users_Model = $Load->model("Users_Model");
				$result      = $Users_Model->getUsername($record["ID_User"]);
				
				if(!$result) {
					$Username = $record["Name"];
				} else {
					$Username  = $result["Username"];
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  	getCheckbox($record["ID_Comment"]), $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		    $color, 				  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		    $record["ID_Comment"], 	      	  	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Application", $Application, 	      	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID_Element",  $record["ID_Element"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Username",    $Username, 	      	      			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Comment",     $record["Comment"], 	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", 	$record["Situation"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",      $action, 			      			$tFoot);	
			} elseif($application === "forums") {
				if($record["Situation"] === "Deleted") {
					$action = $CPanel_Model->action(TRUE, $record["ID_Forum"]);
				} else {
					$action = $CPanel_Model->action(FALSE, $record["ID_Forum"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",  	getCheckbox($record["ID_Forum"]), 	$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		  	$color, 					  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		  	$record["ID_Forum"],      	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	  	$record["Title"], 	  	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Topics", 		$record["Topics"],   	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Replies", 	$record["Replies"],   	  			$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation",	$record["Situation"], 	  	  		$tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",    	$action, 			      	  		$tFoot);	
			} elseif($application === "categories") {
				$Applications_Model    = $Load->model("Applications_Model");
				$ID_Application        = $Applications_Model->getApplicationByCategory($record["ID_Category"]);
				$record["Application"] = $Applications_Model->getApplication($ID_Application);
				
				if($record["Situation"] === "Deleted") {					
					$action = $CPanel_Model->action(TRUE, $record["ID_Category"]);
				} else {					
					$action = $CPanel_Model->action(FALSE, $record["ID_Category"]);
				}
				
				$tFoot = $CPanel_Model->getTFoot($a, "checkbox",    getCheckbox($record["ID_Category"]), $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "i", 		    $color, 					  		 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "ID", 		    $record["ID_Category"],      	  	 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Title", 	    $record["Title"], 	  	  			 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Application", $record["Application"],    	  		 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Language",    $record["Language"],    	  		 $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Situation", 	$record["Situation"], 	  		     $tFoot);
				$tFoot = $CPanel_Model->getTFoot($a, "Action",      $action, 			      	  		 $tFoot);	
			} 

			if($i == 1) {
				$i = 0;
			} else {
				$i++;
			} 
			
			$a++;
			
			if($j == 3) {
				$j = 2; 
			} else {
				$j++;
			}
		}
	} else {
		if($application !== "comments") {
			redirect(path($application . _sh . "cpanel" . _sh .  "add"));
		} else {
			return FALSE;
		}
	}
	
	return $tFoot;	
}

function getFields($application) {
	if($application === "ads") {
		return "ID, Title, Position, Banner, Principal, Situation";
	} elseif($application === "applications") {
		return "ID, Title, CPanel, Adding, BeDefault, Category, Comments, Situation";
	} elseif($application === "blog") {
		return "ID, Title, Author, Language, Situation";
	} elseif($application === "categories") {
		return "ID, Title, Application, Language, Situation";
	} elseif($application === "gallery") {
		return "ID, Title, Album, Image, Situation";
	} elseif($application === "pages") {
		return "ID, Title, Language, Principal, Situation";
	} elseif($application === "links") {
		return "ID, Title, Url, Category, Situation";
	} elseif($application === "videos") {
		return "ID, Title, Video, Situation";
	} elseif($application === "feedback") {
		return "ID, Name, Email, Subject, Date, Situation";
	} elseif($application === "users") {
		return "ID, Username, Email, Situation";
	} elseif($application === "polls") {
		return "ID, Title, Type, Situation";
	} elseif($application === "comments") {
		return "ID, Application, ID_Element, Username, Comment, Situation";
	} elseif($application === "forums") {
		return "ID, Title, Topics, Replies, Situation";
	} elseif($application === "works") {
		return "ID, Title, Image, Preview1, Preview2, Situation";
	}
	
}

function getSearch() {
	global $Load;
	
	$Load->helper(array("forms", "html"));

	$application = whichApplication();
	
	if($application === "users") {
		$field = "username";
		$name  = __(_("Username"));
	} else {
		$field = "title";
		$name  = __(_("Title"));			
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
	$HTML .= bold("&nbsp". __(_("Search")) .":", FALSE);

	$attributes = array(
		"p" 	=> FALSE,
		"name" 	=> "search",
		"class" => "span 1 required"
	);

	$HTML .= formInput($attributes);

	$HTML .= bold(" ". __(_("Field")) .":", FALSE);
	
	$i = 0;		

	foreach($fields as $field) {
		$fields[$i]["value"]    = $field["field"];
		$fields[$i]["option"]   = $field["name"];
		$fields[$i]["selected"] = $field["selected"];
		
		$i++;
	}
	
	$HTML .= formSelect(array("name" => "field", "class" => "span2 required"), $fields);
	
	$HTML .= bold(__(_("Order")) . ":", FALSE);
	
	$options[0]["value"]    = "ASC";
	$options[0]["option"]   = __(_("Ascending"));
	$options[0]["selected"] = TRUE;
	$options[1]["value"]    = "DESC";
	$options[1]["option"]   = __(_("Descending"));
	$options[1]["selected"] = FALSE;
	
	$HTML .= formSelect(array("name" => "order", "class" => "span2 required"), $options);
	$HTML .= formInput(array("name" => "seek", "type" => "submit", "class" => "btn btn-info", "value" => __(_("Seek"))));	
	
	return $HTML;
}
