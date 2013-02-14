<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Applications_Model extends ZP_Load {
		
	public function __construct() {
		$this->Db = $this->db();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		$this->Users_Model = $this->model("Users_Model");
		
		$this->table = "applications";
	}
		
	public function getList() {
		$data = $this->Db->findAll($this->table, "ID_Application, Title, Slug, CPanel, Adding, BeDefault, Comments, Situation", null, "Title ASC");

		$list  = null;		
		
		if ($data) { 
			$this->helper(array("array", "html"));

			foreach ($data as $application) { 
				if ($application["Situation"] === "Active") {
					if ($application["CPanel"]) {
						$count = $this->CPanel_Model->pendingRecords($application["Slug"]);	

						$title = __($application["Title"]) . ($count > 0 ? htmlTag("span", array("style" => "color: #f00"), " ($count)") : "");
						
						if ($this->Users_Model->isAllow("view", $application["Title"])) {	
							if ($application["Slug"] === "configuration") {
								$list[]["item"] = span("bold", a($title, path($application["Slug"] . SH ."cpanel". SH ."edit")));															
							} else {
								$list[]["item"] = span("bold", a($title, path($application["Slug"] . SH ."cpanel". SH ."results")));
							}
							
							$list[count($list) - 1]["Class"] = false;								
									
							if ($application["Adding"]) {
								$adding = __("Add");
								
								$li[0]["item"] = a($adding, path($application["Slug"] . SH ."cpanel". SH ."add"));

								if ($application["Slug"] == "codes") {
									$languages = __("Programming languages");
									$li[]["item"] = a($languages, path($application["Slug"] . SH ."cpanel". SH ."languages"));
								}
								
								$i = count($list);			
														
								$list[$i]["item"]  = openUl();							
								
								$count = $this->CPanel_Model->deletedRecords($application["Slug"]);		
											
								if ($count > 0) {	
									$span  = span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
									$span .= span("bold italic blue", __("Trash") ." ($count)");
									
									$li[]["item"] = a($span, path($application["Slug"] ."/cpanel/results/trash"), false, array("title" => __("In trash") .": ". $count));
									
									$i = count($list) - 1;
									
									$list[$i]["item"] .= li($li);
									
									unset($li);	
								} else {
									$list[$i]["item"] .= li($li);
								}
															
								$list[$i]["item"] .= closeUl();
								$list[$i]["class"] = "no-list-style";																
									
								unset($li);								
							}

							if ($application["Slug"] == "configuration") {
								$li[]["item"] = a(__("Minifier"), path($application["Slug"] ."/cpanel/minifier"));
								$li[]["item"] = a("TV", path($application["Slug"] ."/cpanel/tv"));
								
								$i = count($list);
								
								$list[$i]["item"]  = openUl() . li($li) . closeUl();
								$list[$i]["class"] = "no-list-style";	

								unset($li);	
							}
						}
					}							
				}
			}
		}
		
		return $list;		
	}	
			
	public function getApplication($ID) {
		$application = $this->Db->find($ID, $this->table, "Title");
	
		return $application[0]["Title"];
	}
	
	public function getID($title) {		
		$applications = $this->Db->findBy("Title", $title, $this->table, "ID_Application");

		return (is_array($applications)) ? $applications[0]["ID_Application"] : false;
	}	
	
	public function getApplications() {
		return $this->Db->findBy("Situation", "Active", $this->table, "ID_Application, Title, CPanel, Adding, BeDefault, Comments, Situation");
	}
	
	public function getDefaultApplications($default = false) {	
		$applications = $this->Db->findBySQL("BeDefault = 1 AND Situation = 'Active'", $this->table, "Title, Slug");
		
		$i = 0;
		foreach ($applications as $application) {
			if ($application["Slug"] === $default) {
				$options[$i]["value"] = $application["Slug"];
				$options[$i]["option"] = $application["Title"];
				$options[$i]["selected"] = true;
			} else {
				$options[$i]["value"] = $application["Slug"];
				$options[$i]["option"] = $application["Title"];
				$options[$i]["selected"] = false;
			}
				
			$i++;
		}
				
		return $options;		
	}	
	
	public function getByID($ID) {	
		return $this->Db->find($ID, $this->table, "ID_Application, Title, CPanel, Adding, BeDefault, Comments, Situation");
	}
}