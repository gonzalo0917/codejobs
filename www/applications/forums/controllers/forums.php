<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Controller extends ZP_Controller {
	
	private $pagination = NULL;
	
	public function __construct() {
		$this->config("forums");

		$this->Templates    = $this->core("Templates");
		$this->Forums_Model = $this->model("Forums_Model");
		
		$this->CSS("colorbox", "forums");
		$this->CSS("style", "forums");
		
		$this->js("jquery.colorbox-min", "forums");
		$this->js("users", "forums");
		$this->js("actions", "forums");

		$this->Templates->theme();
	}
	
	public function index() {
		$this->title("Forums");
		
		if(!is_numeric(segment(1, isLang())) and segment(2, isLang()) !== "new" and segment(2, isLang()) > 0 and segment(3, isLang()) === "new") {
			$this->setReply();
		} elseif(!is_numeric(segment(1, isLang())) and segment(2, isLang()) !== "new" and segment(2, isLang()) > 0 and segment(3, isLang()) === "edit" and segment(4, isLang()) > 0) {
			$this->setReply();
		} elseif(!is_numeric(segment(1, isLang())) and segment(2, isLang()) !== "new" and segment(2, isLang()) > 0 and segment(3, isLang()) === "edit") {
			$this->setTopic();
		} elseif(!is_numeric(segment(1, isLang())) and segment(2, isLang()) !== "new" and segment(2, isLang()) > 0 and segment(3, isLang()) === "delete" and segment(4, isLang()) > 0) {
			$this->deleteReply();
		} elseif(!is_numeric(segment(1, isLang())) and segment(2, isLang()) !== "new" and segment(2, isLang()) > 0 and segment(3, isLang()) === "delete") {
			$this->deleteTopic();
		} elseif(!is_numeric(segment(1, isLang())) and segment(2, isLang()) !== "new" and segment(2, isLang()) > 0) {	
			$this->getByTopic();
		} elseif(segment(2, isLang()) === "new") {
			$this->setTopic();
		} elseif(segment(1, isLang()) !== FALSE) {
			$this->getByForum();			
		} else {
			$this->getByDefault();			
		}		
	}
	
	private function getByDefault() {
		$language = whichLanguage();

		$data = $this->Forums_Model->getByDefault($language);
		
		if($data) {
			$avatar = $this->Forums_Model->getUserAvatar();
			$stats  = $this->Forums_Model->getStatistics();
			$users  = $this->Forums_Model->getLastUsers();
			
			$vars["users"]  = $users;		
			$vars["stats"]  = $stats;
			$vars["avatar"] = $avatar;
			$vars["forums"] = $data;
			$vars["URL"]	= path("forums");
			$vars["view"]   = $this->view("forums", TRUE);
			
			$this->render("content", $vars);			
		} else {
			redirect();
		}	
	}
	
	private function getByForum() {
		$slug 	  = segment(1, isLang());
		$language = whichLanguage();
		$data 	  = $this->Forums_Model->getByForum($slug, $language);
		
		if($data) {
			$avatar = $this->Forums_Model->getUserAvatar();
			$stats  = $this->Forums_Model->getStatistics();
					
			$vars["stats"]  = $stats;
			$vars["avatar"] = $avatar;
			$vars["forums"] = $data;
			$vars["forum"]  = $data[0];
			$vars["topics"] = $data[1];
			$vars["URL"]	= path("forums/". $slug);
			$vars["view"]   = $this->view("forum", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect("forums");
		}
	}

	private function getByTopic() {		
		$ID = segment(2, isLang());
		$forum = segment(1, isLang());
		
		$page = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? segment(4, isLang()) : 0;
							
		$end = _maxLimit;

		$start = ($page === 0) ? 0 : ($page * $end) - $end; 
		
		$limit = $start .", ". $end;
		$URL   = path("forums/$forum/$ID/page/");
		
		$data = $this->Forums_Model->getByTopic($ID, $limit);
		
		if(!$data["replies"] and $page > 1) {
			redirect("forums/$forum/$ID/");
		}
		
		$count = $this->Forums_Model->countRepliesByTopic($ID);
		
		if($count > $end) {
			 $pagination = paginate($count, _maxLimit, $start, $URL);
		}
		
		if($data["topic"]) {		
			$this->Forums_Model->addVisit($ID);
			
			$visit  = $this->Forums_Model->addUserVisit();
			$avatar = $this->Forums_Model->getUserAvatar();
			$stats  = $this->Forums_Model->getStatistics();
			$users  = $this->Forums_Model->getLastUsers();
			
			$vars["users"]  = $users;		
			$vars["stats"]  = $stats;
			$vars["avatar"] = $avatar;
			$vars["forums"] = $data;
				
			if(isset($pagination)) {
				$vars["pagination"] = $pagination;
			}
			
			$vars["count"] = $count;
			$vars["data"]  = $data;

			if($page > 0) {
				$vars["URL"] = path("forums" ."/". $forum ."/". $ID ."/". "page" ."/". $page);
			} else {
				$vars["URL"] = path("forums" ."/". $forum ."/". $ID);
			}

			$vars["view"]  = $this->view("topic", "forums", TRUE);
				
			$this->render("content", $vars);
		} else {
			redirect("forums" ."/". segment(1, isLang()));
		}
	}
	
	private function setTopic() {
		$slug 	  = segment(1, isLang());
		$language = whichLanguage();
		
		if(segment(3, isLang())) {
			$action = "edit";
			$ID     = segment(2, isLang());
		} else { 
			$action = "save";
		}
		
		if(SESSION("ZanUserID") > 0) {
			$this->js("tiny-mce", NULL, "basic");
			$this->js("validations", "forums");
			
			if(POST("cancel")) {
				redirect("forums" ."/". $slug);
			}
			
			if(!POST("doAction")) {
				if($action === "save") {
					$forum = $this->Forums_Model->getIDByForum($slug, $language);
				} elseif($action === "edit") {
					$forum = $this->Forums_Model->getTopicByID($ID);

					$vars["ID_Post"] = $ID;
				}
				
				if($forum) {
					$vars["ID"]       = $forum[0]["ID_Forum"];
					$vars["title"]    = (isset($forum[0]["Title"]))   ? $forum[0]["Title"]   : "";
					$vars["content"]  = (isset($forum[0]["Content"])) ? $forum[0]["Content"] : "";
					$vars["action"]   = $action;
					$vars["hrefURL"]  = path("forums" ."/". $slug . _sh);
					
					if($action === "save") {
						$vars["href"] = path("forums" ."/". $slug ."/". "new");
					} else {
						$vars["href"] = path("forums" ."/". $slug ."/". $ID ."/". "edit");
					}

					$vars["view"] = $this->view("newtopic", "forums", TRUE);
					
					$this->render("content", $vars);
				}
			} else {
				if(!POST("title")) {
					$alert = getAlert("You must to write a title");
				} elseif(isEmptyTiny(POST("content", "decode", FALSE))) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("title")) < 4) {
					$alert = getAlert("You must to write a valid title");
				} elseif(!POST("content")) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("content")) < 4) {
					$alert = getAlert("You must to write a valid content");
				} elseif(isInjection(POST("content", "decode", FALSE))) {
					$alert = getAlert("The content is invalid");
				} elseif(isVulgar(strtolower(POST("title")))) {
					$alert = getAlert("The title is vulgar");
				} elseif(isVulgar(strtolower(POST("content")))) {
					$alert = getAlert("The content is vulgar");
				} elseif(isSPAM(POST("content"))) {
					$alert = getAlert("The content has spam");
				} 
				
				if(isset($alert)) {
					$vars["alert"]   = $alert;
					$vars["ID"]      = POST("ID_Forum");
					$vars["title"]   = POST("title");
					$vars["content"] = cleanTiny(POST("content", "decode", FALSE));
					$vars["action"]  = $action;
					$vars["hrefURL"] = path("forums" ."/". $slug . _sh);
					
					if($action === "save") {
						$vars["href"] = path("forums" ."/". $slug ."/". "new");
					} else {
						$vars["href"] = path("forums" ."/". $slug ."/". $ID ."/". "edit");
					}

					$vars["view"] = $this->view("newtopic", "forums", TRUE);
					
					$this->render("content", $vars);
				} else {
					if($action === "save") {
						$success = $this->Forums_Model->setTopic();
						
						if($success > 0) {
							$topic = $this->Forums_Model->addUserTopic();
							
							$vars["href"] = path("forums" ."/". $slug ."/". $success . _sh);
						}
					} elseif($action === "edit") { 
						$success = $this->Forums_Model->editTopic();

						$vars["href"] = path("forums" ."/". $slug ."/". $ID . _sh);
					}
									
					$vars["success"] = $success;
					$vars["action"]  = $action;
					$vars["href"]    = path("forums" ."/". $slug);
					$vars["view"]    = $this->view("newtopic", "forums", TRUE);
					
					$this->render("content", $vars);
				}
			}
		} else {
			redirect("forums" ."/". $slug);
		}
	}
	
	private function setReply() {
		$ID_Topic = segment(2, isLang());
		
		if(segment(3, isLang()) === "edit") {
			$action = "edit";
			
			$ID_Reply = segment(4, isLang());
		} elseif(segment(3, isLang()) === "new") { 
			$action = "save";
		}
		
		$page = (segment(5, isLang()) > 0) ? segment(5, isLang()) : 1;
			
		if(SESSION("ZanUserID") > 0) {
			$this->js("tiny-mce", NULL, "basic");
			$this->js("validations", "forums");
			
			if(POST("cancel")) {
				redirect("forums" ."/". segment(1, isLang()) ."/". segment(2, isLang()));
			}
			
			if(!POST("doAction")) {
				if($action === "save") {
					$topic = $this->Forums_Model->getTopicByID($ID_Topic);
				} elseif($action === "edit") {
					$topic = $this->Forums_Model->getTopicByID($ID_Reply);
				}
				
				if($topic) {
					$vars["ID_Post"]  = $topic[0]["ID_Post"];
					$vars["ID_Forum"] = $topic[0]["ID_Forum"];
					
					if($action === "save") {
						$vars["title"]   = "Re: " . $topic[0]["Title"];
						$vars["content"] = "";
						$vars["href"]    = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "new");
						$vars["hrefURL"] = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic);
					} elseif($action === "edit") {
						$vars["title"]    = $topic[0]["Title"];
						$vars["content"]  = $topic[0]["Content"];
						$vars["ID_Topic"] = $topic[0]["ID_Parent"];
						$vars["hrefURL"]  = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "page" ."/". $page);
						$vars["href"]     = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "edit" ."/". $ID_Reply ."/". $page);
					}
					
					$vars["action"] = $action;					
					$vars["view"]   = $this->view("reply", "forums", TRUE);
					
					$this->render("content", $vars);
				}
			} else {
				if(!POST("title")) {
					$alert = getAlert("You must to write a title");
				} elseif(isEmptyTiny(POST("content", "decode", FALSE))) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("title")) < 4) {
					$alert = getAlert("You must to write a valid title");
				} elseif(!POST("content")) {
					$alert = getAlert("You must to a write a content");
				} elseif(strlen(POST("content")) < 4) {
					$alert = getAlert("You must to write a valid content");
				} elseif(isInjection(POST("content", "decode", FALSE))) {
					$alert = getAlert("The content is invalid");
				} elseif(isEmptyTiny(POST("content","decode", FALSE))) {
					$alert = getAlert("The content is invalid");
				} elseif(isVulgar(strtolower(POST("title")))) {
					$alert = getAlert("The title is vulgar");
				} elseif(isVulgar(strtolower(POST("content")))) {
					$alert = getAlert("The content is vulgar");
				} elseif(isSPAM(POST("content"))) {
					$alert = getAlert("The content has spam");
				} 
				
				if(isset($alert)) {
					$vars["alert"]    = $alert;
					$vars["ID_Post"]  = POST("ID_Post");
					$vars["ID_Forum"] = POST("ID_Forum");
					$vars["title"]    = POST("title");
					$vars["content"]  = cleanTiny(POST("content", "decode", FALSE));
					$vars["action"]   = $action;
					
					if($action === "save") {
						$vars["href"]    = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "new");
						$vars["hrefURL"] = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic);
					} elseif($action === "edit") {
						$vars["ID_Topic"] = POST("ID_Topic");
						$vars["href"]     = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "edit" ."/". $ID_Reply ."/". $page);
						$vars["hrefURL"]  = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "page" ."/". $page);
					}

					$vars["view"] = $this->view("reply", "forums", TRUE);
					
					$this->render("content", $vars);
				} else {
					if($action === "save") {
						$success = $this->Forums_Model->setReply();
						
						if($success > 0) {
							$page  = $this->Forums_Model->getPage($ID_Topic);
							$reply = $this->Forums_Model->addUserReply();
						} else {
							$page = 1;
						}
					} elseif($action === "edit") {
						$success = $this->Forums_Model->editReply();
					}
					
					$vars["success"] = $success;
					$vars["action"]  = $action;
					
					if($action === "save") {
						$vars["href"] = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "page" ."/". $page ."/". "#bottom");
					} elseif($action === "edit") {
						$vars["href"] = path("forums" ."/". segment(1, isLang()) ."/". $ID_Topic ."/". "page" ."/". $page);
					}
					
					$vars["view"] = $this->view("reply", "forums", TRUE);
					
					$this->render("content", $vars);
				}
			}
		} else {
			redirect("forums" ."/". segment(1, isLang()) ."/". segment(2, isLang()) . _sh);
		}
	}
	
	private function deleteTopic() {
		$ID = segment(2, isLang());
		
		if(SESSION("ZanUserID")) {
			$delete = $this->Forums_Model->deleteTopic($ID);
			
			if($delete) {
				redirect("forums" ."/". segment(1, isLang()) . _sh);
			} else {
				redirect("forums" ."/". segment(1, isLang()) . _sh);
			}	
		} else {
			redirect("forums" ."/". segment(1, isLang()) . _sh);
		}
	}
	
	private function deleteReply() {
		$ID = segment(4, isLang());

		if(segment(6) > 0) {
			$page = segment(6);
		} else { 
			$page = 1;
		}
		
		if(SESSION("ZanUserID")) {
			$delete = $this->Forums_Model->deleteReply($ID);
			
			if($delete) {
				redirect("forums" ."/". segment(1, isLang()) ."/". segment(2, isLang()) ."/". "page" ."/". $page);
			} else {
				redirect("forums" ."/". segment(1, isLang()) . _sh);
			}	
		} else {
			redirect("forums" ."/". segment(1, isLang()) . _sh);
		}
	}

}