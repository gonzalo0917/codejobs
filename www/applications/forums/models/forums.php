<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();	
                
        $this->language = whichLanguage();
		$this->table    = "forums";
		$this->fields   = "ID_Forum, Title, Slug, Description, Topics, Replies, Last_Reply, Last_Date, Language, Situation";

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit) {
        return ($trash) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, NULL, $order, $limit) : $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, NULL, $order, $limit);		
	}
	
	private function editOrSave() {
        $validations = array(
			"exists"  => array(
				"Year"	   => date("Y"),
				"Month"	   => date("m"),
				"Day"	   => date("d"),
				"Language" => POST("language")
			),
			"title"   => "required",
			"description" => "required"
		);
            
        $this->URL = path("blog/". date("Y")) ."/". date("m") ."/". date("d") ."/". slug(POST("title", "clean"));
				
		$data = array(
			"ID_Forum"     => POST("ID"),
            "Title"        => POST("title", "clean"),
			"Slug"         => slug(POST("title", "clean")),
			"Description"  => POST("description", "clean"),
			"Language"     => POST("language"),
            "Situation"    => POST("situation")
		);
	
		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {
        if($this->getIDByForum($this->data["Slug"])){
            return getAlert(__("This forum already exists"), "error", $this->URL);
        } 
        
        $this->Db->insert($this->table, $this->data);
        
        return getAlert(__("The forum has been saved correctly"), "success", $this->URL);
	}
	
	private function edit() {
        $forum = $this->getIDByForum($this->data["Slug"]);
        
        if($forum){
            if($Forum[0]["ID_Forum"] != $this->data["ID_Forum"]){
                return getAlert(__("This forum already exists"), "error", $this->URL);
            }
        }
        
        $this->Db->update($this->table, $this->data, POST("ID"));	
		
		return getAlert(__("The forum has been edited correctly"), "success", $this->URL);
	}
	
	public function getByID($ID) {		
		$data = $this->Db->find($ID, $this->table);
		
		return $data;
	}
	
	public function getByDefault($language = "Spanish") {
		$forums = $this->Db->findBySQL("Language = '$language' AND Situation = 'Active'", $this->table);
		
		if($forums) {
			$i = 0;

			foreach($forums as $forum) {
				$data[$i]["ID_Forum"]    = $forum["ID_Forum"];
				$data[$i]["Title"]       = $forum["Title"];
				$data[$i]["Slug"]        = $forum["Slug"];
				$data[$i]["Description"] = $forum["Description"];
				$data[$i]["editURL"]     = path($this->application ."/action/edit/". $forum["ID_Forum"]);
				$data[$i]["deleteURL"]   = path($this->application ."/action/trash/". $forum["ID_Forum"]);
				
				if($forum["Topics"] < 1) {
					$data[$i]["Topics"]     = 0;
					$data[$i]["Replies"]    = 0;
					$data[$i]["Last_Reply"] = __("There are not replies");
					$data[$i]["Last_Date"]  = NULL;
					$data[$i]["Situation"]  = $forum["Situation"];
				} else {
					$data[$i]["Topics"]  = $forum["Topics"];
					$data[$i]["Replies"] = $forum["Replies"];
					
					$ID_Last = $forum["Last_Reply"];
					
					$reply = $this->Db->findBySQL("ID_Post = '$ID_Last' AND Situation = 'Active'", "forums_posts");
					
					if($reply) {
						$data[$i]["Last_Reply"]           = $forum["Last_Reply"];
						$data[$i]["Last_Reply_Title"]     = $reply[0]["Title"];
						$data[$i]["Last_Reply_Slug"]      = $reply[0]["Slug"];
						$data[$i]["Last_Reply_Author"]    = $reply[0]["Author"];
						$data[$i]["Last_Reply_Author_ID"] = $reply[0]["ID_User"];
						$data[$i]["Last_Reply_Content"]   = $reply[0]["Content"];				
						$data[$i]["Last_Date"]            = $forum["Last_Date"];
						$data[$i]["Last_Date2"]           = $reply[0]["Start_Date"];

						$page = $this->getPage($reply[0]["ID_Parent"]);
						
						$data[$i]["Last_URL"] = path("forums/". $data[$i]["Slug"] ."/". $reply[0]["ID_Parent"] ."/page/". $page ."/#bottom");
					} else {
						$ID_Forum = $forum["ID_Forum"];
						
						$topic = $this->Db->findBySQL("ID_Forum = '$ID_Forum' AND Topic = 1 and Situation = 'Active' ORDER BY ID_Post DESC LIMIT 1", "forums_posts");
						
						$data[$i]["Last_Reply"]           = $topic[0]["ID_Post"];
						$data[$i]["Last_Reply_Title"]     = $topic[0]["Title"];
						$data[$i]["Last_Reply_Slug"]      = $topic[0]["Slug"];
						$data[$i]["Last_Reply_Author"]    = $topic[0]["Author"];
						$data[$i]["Last_Reply_Author_ID"] = $topic[0]["ID_User"];
						$data[$i]["Last_Reply_Content"]   = $topic[0]["Content"];				
						$data[$i]["Last_Date"]            = $topic[0]["Text_Date"];
						$data[$i]["Last_Date2"]           = $topic[0]["Start_Date"];
						$data[$i]["Last_URL"]             = path("forums" . _sh . $data[$i]["Slug"] . _sh . $topic[0]["ID_Post"] . _sh);
					}
				}				
				
				$i++;
			}

			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function getByForum($Slug, $language = "Spanish") {	
		$forum = $this->Db->findBySQL("Slug = '$slug' AND Language = '$language' AND Situation = 'Active'", $this->table);

		$dataForum["Forum_Title"] = $forum[0]["Title"];	
		$dataForum["Forum_Slug"]  = $forum[0]["Slug"];
		
		if($forum) {			
			$ID_Forum = $forum[0]["ID_Forum"];
		
			$topics = $this->Db->findBySQL("ID_Forum = '$ID_Forum' AND ID_Parent = '0' AND Topic = 1 AND Situation = 'Active' ORDER BY ID_Post DESC", "forums_posts");
			
			if($topics) {
				$i = 0;

				foreach($topics as $topic) {
					$dataTopic[$i]["Author"]      = $topic["Author"];
					$dataTopic[$i]["Author_ID"]   = $topic["ID_User"];
					$dataTopic[$i]["Title"]       = $topic["Title"];
					$dataTopic[$i]["Slug"]        = $topic["Slug"];
					$dataTopic[$i]["Start_Date"]  = $topic["Start_Date"];
					$dataTopic[$i]["Text_Date"]   = $topic["Text_Date"];
					$dataTopic[$i]["Hour"]        = $topic["Hour"];
					$dataTopic[$i]["Visits"]      = $topic["Visits"];
					$dataTopic[$i]["ID"]          = $topic["ID_Post"];	
					$dataTopic[$i]["topicURL"]    = path(segment(1, isLang()) ."/new");
					$dataTopic[$i]["replyURL"]    = path(segment(1, isLang()) . $topic["ID_Post"] ."/new");
					$dataTopic[$i]["editURL"]     = path(segment(1, isLang()) . $topic["ID_Post"] ."/edit");
					$dataTopic[$i]["deleteURL"]   = path(segment(1, isLang()) . segment(2, isLang()) ."/". $topic["ID_Post"] ."/delete");
																		
					$ID_Topic = $topic["ID_Post"];

					$dataTopic[$i]["Count"] = $this->Db->countBySQL("ID_Forum = '$ID_Forum' AND ID_Parent = '$ID_Topic' AND Situation = 'Active'", "forums_posts");
					
					if($dataTopic[$i]["Count"] > 0) {
						$query = "ID_Forum = '$ID_Forum' AND ID_Parent = '$ID_Topic' AND Situation = 'Active' ORDER BY Start_Date DESC LIMIT 1";

						$lastReply = $this->Db->findBySQL($query, "forums_posts");

						$dataTopic[$i]["Last_Author"]    = $lastReply[0]["Author"];
						$dataTopic[$i]["Last_Author_ID"] = $lastReply[0]["ID_User"];
						$dataTopic[$i]["Last_Title"]     = $lastReply[0]["Title"];
						$dataTopic[$i]["Last_Slug"]      = $lastReply[0]["Slug"];
						$dataTopic[$i]["Last_Start"]     = $lastReply[0]["Start_Date"];
						$dataTopic[$i]["Last_Text"]      = $lastReply[0]["Text_Date"];
						$dataTopic[$i]["Last_ID"]        = $lastReply[0]["ID_Post"];

						$page = $this->getPage($dataTopic[$i]["ID"]);

						$dataTopic[$i]["Last_URL"] = path("forums/". segment(1, isLang()) ."/". $dataTopic[$i]["ID"] ."/page/". $page ."/#bottom");
					} else {
						$dataTopic[$i]["Count"]      = 0;
						$dataTopic[$i]["Last_Reply"] = __("There are not replies");
					}

					$i++;					
				}
				
				$data[0] = $dataForum;
				$data[1] = $dataTopic;

				return $data;
			} else {
				$data[0] = $dataForum;
				$data[1] = FALSE;

				return $data;
			}			
		} else {
			return FALSE;
		}
	}
	
	public function getIDByForum($slug, $language = "Spanish") {
		return $this->Db->findBySQL("Slug = '$slug' AND Language = '$language'", $this->table, $this->fields);
	}
	
	public function setTopic() {
		$ID      = POST("ID_Forum");
		$title   = POST("title", "decode", "escape");
		$content = cleanTiny(POST("content", "decode", FALSE));
		$slug    = slug($title);
		$ID_User = SESSION("ZanUserID");
		$author  = SESSION("ZanUser");
		$date1   = now(4);
		$date2   = now(2);
		$hour    = date("H:i:s", $date1);
		
		$lastTopic = $this->Db->findBySQL("ID_User = '$ID_User' AND ID_Parent = 0 AND Situation = 'Active' ORDER BY Start_Date DESC LIMIT 1", "forums_posts");
		
		if($lastTopic) {
			$time = $date1 - $lastTopic[0]["Start_Date"];
		} else { 
			$time = 100;
		}
		
		if($time > 25) {
			$data = $this->Db->call("setTopicForum('$ID', '$ID_User', '$title', '$Slug', '$content', '$author', '$date1', '$date2', '$hour')");
		} else { 
			$data = 0;
		}
		
		if(is_array($data)) {
			if(POST("tweet") === "Yes") {
				if(SESSION("ZanUserMethod") === "twitter") {
					$this->Twitter_Model = $this->model("Twitter_Model");

					$tweet = __("I posted on") ." ". $title;

					$this->Twitter_Model->publish($tweet, POST("URL") . $data[0]["Last_ID"]);
				}
			}
			
			return $data[0]["Last_ID"];
		} elseif($data === 0) {
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function editTopic() {
		$ID_Post  = POST("ID_Post");
		$title    = POST("title", "decode", "escape");
		$content  = cleanTiny(POST("content", "decode", FALSE));
		$slug     = slug($title);
		$date1    = now(4);
		$date2    = now(2);
		$hour     = date("H:i:s", $date1);
		
		$data = $this->Db->call("updateTopicForum('$ID_Post', '$title', '$Slug', '$content', '$date1', '$date2', '$hour')");
		
		$this->Db->updateBySQL("forums_posts", "Title = 'Re: $title' WHERE ID_Parent = '$ID_Post'");
		
		if($data) {			
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function countRepliesByTopic($ID) {
		$count = $this->Db->countBySQL("ID_Parent = '$ID' AND Situation = 'Active'", "forums_posts");
		
		return $count;
	}
	
	public function getPage($ID) {
		$total = $this->countRepliesByTopic($ID);
		$page  = $total / _maxLimit;
		
		if(is_float($page)) {
			$page = intval($page) + 1;
			
			return $page;
		} else {
			return $page;
		}
	}
	
	public function addVisit($ID) {
		$this->Db->table("forums_posts");
		
		$values = "Visits = (Visits) + 1";
		
		$this->Db->values($values);
		$this->Db->save($ID);
	}
	
	public function getByTopic($ID, $limit) {	
		$topic = $this->Db->call("getTopicForum('$ID')");

		$replies = $this->Db->query("SELECT * FROM ". get("dbPfx") ."forums_posts 
										INNER JOIN ". get("dbPfx") ."users ON ". get("dbPfx") ."users.ID_User = ". get("dbPfx") ."forums_posts.ID_User 
										INNER JOIN ". get("dbPfx") ."users_information ON ". get("dbPfx") ."users_information.ID_User = ". get("dbPfx") ."users.ID_User 
										WHERE ID_Parent = '$ID' AND Situation = 'Active' ORDER BY ID_Post LIMIT $limit");
		
		if($topic) {
			$topic[0]["replyURL"]  = path("forums/". segment(1, isLang()) ."/". $topic[0]["ID_Post"] ."/new");
			$topic[0]["editURL"]   = path("forums/". segment(1, isLang()) ."/". $topic[0]["ID_Post"] ."/edit");
			$topic[0]["deleteURL"] = path("forums/". segment(1, isLang()) ."/". $topic[0]["ID_Post"] ."/delete");
		}
		
		if($replies) {
			$i = 0;

			foreach($replies as $reply) {
				if(segment(4) === "page" and segment(5) > 0) {
					$page = segment(5);

					$replies[$i]["deleteURL"] = path($this->application ."/". segment(2) ."/". $topic[0]["ID_Post"] ."/delete/". $reply["ID_Post"] ."/". $page);
					$replies[$i]["editURL"]   = path($this->application ."/". segment(2) ."/". $topic[0]["ID_Post"] ."/edit/". $reply["ID_Post"] ."/". $page);
				} else {
					$replies[$i]["deleteURL"] = path($this->application ."/". segment(2) ."/". $topic[0]["ID_Post"] ."/delete/". $reply["ID_Post"]);
					$replies[$i]["editURL"]   = path($this->application ."/". segment(2) ."/". $topic[0]["ID_Post"] ."/edit/". $reply["ID_Post"]);
				}
				
				$i++;
			}
		}
		
		$data["topic"]   = $topic;
		$data["replies"] = $replies;

		return $data;
	}
	
	public function getTopicByID($ID) {
		$data = $this->Db->findBySQL("ID_Post = '$ID'", "forums_posts");
		
		return $data;
	}
	
	public function setReply() {
		$ID_Forum = POST("ID_Forum");
		$ID_Post  = POST("ID_Post");
		$title    = POST("title", "decode", "escape");
		$content  = cleanTiny(POST("content", "decode", FALSE));
		$slug     = slug($title);
		$ID_User  = SESSION("ZanUserID");
		$author   = SESSION("ZanUser");
		$date1    = now(4);
		$date2    = now(2);
		$hour     = date("H:i:s", $date1);
		
		$lastTopic = $this->Db->findBySQL("ID_User = '$ID_User' AND ID_Parent > 0 AND Situation = 'Active' ORDER BY Start_Date DESC LIMIT 1", "forums_posts");
		
		if($lastTopic) {
			$time = $date1 - $lastTopic[0]["Start_Date"];
		} else { 
			$time = 100;
		}
		
		if($time > 25) {
			$data = $this->Db->call("setReplyTopic('$ID_Forum', '$ID_Post', '$ID_User', '$title', '$Slug', '$content', '$author', '$date1', '$date2', '$hour')");
		} else { 
			$data = 0;
		}
		
		if(is_array($data)) {
			return $data[0]["Last_ID"];
		} elseif($data === 0) {
			return $data;
		} else {
			return FALSE;
		}
	}
	
	public function editReply() {
		$ID_Post  = POST("ID_Post");
		$title    = POST("title", "decode", "escape");
		$content  = cleanTiny(POST("content", "decode", FALSE));
		$Slug     = Slug($title);
		$date1    = now(4);
		$date2    = now(2);
		$hour     = date("H:i:s", $date1);
		
		$this->Db->call("updateReplyTopic('$ID_Post', '$title', '$Slug', '$content', '$date1', '$date2', '$hour')");
	 	
		return TRUE;
	}
	
	public function getUserAvatar($ID = 0) {
		if($ID === 0) {
			if(SESSION("ZanUserID")) {
				$ID = SESSION("ZanUserID");
			} else {
				return path("www/lib/files/images/users/default.png", TRUE);
			}
		}
		
		$avatar = $this->Db->find($ID, "users");

		if($avatar) {
			if($avatar[0]["Type"] === "Normal") {
				if($avatar[0]["Avatar"] !== "") {
					return path($avatar[0]["Avatar"], TRUE);
				} elseif($avatar[0]["Avatar"] === "") {
					return path("www/lib/files/images/users/default.png", TRUE);
				} 
			} elseif($avatar[0]["Type"] === "Twitter") {
				return $avatar[0]["Avatar"];
			}
		} else {
			return FALSE;
		}
	}
	
	public function addUserTopic() {
		if(SESSION("ZanUserID")) {
			$this->Db->updateBySQL("users", "Topics = (Topics) + 1 WHERE ID_User = '". SESSION("ZanUserID") ."'");
		} else {
			return FALSE;
		}
	}
	
	public function addUserReply() {
		if(SESSION("ZanUserID")) {
			$this->Db->updateBySQL("users", "Replies = (Replies) + 1 WHERE ID_User = '". SESSION("ZanUserID") ."'");
		} else {
			return FALSE;
		}
	}
	
	public function getStatistics() { 
		if(SESSION("ZanUserID")) {
			return $this->Db->find(SESSION("ZanUserID"), "users");
		} else { 
			return FALSE;
		}
	}
	
	public function setRank($ID_User, $rank = FALSE) {
		$ranks[0]  = "Beginner";
		$ranks[1]  = "Advanced Beginner";
		$ranks[2]  = "Member";
		$ranks[3]  = "Full Member";
		$ranks[4]  = "Silver Member";
		$ranks[5]  = "Gold Member";
		$ranks[6]  = "Platinum Member";
		$ranks[7]  = "God of the Forum";
		$ranks[8]  = "Moderator";
		$ranks[9]  = "Administrator";
		$ranks[10] = "Super Administrator";
			
		if(!$rank) {
			$user = $this->Db->find($ID_User, "users");
			
			$normalPoints = $user[0]["Topics"] + $user[0]["Replies"];
			$visitPoints  = $user[0]["Visits"] / 50;
			$points  	  = intval($normalPoints + $visitPoints);
			$actualRank   = $user[0]["Rank"];
				
			if($actualRank !== "Super Administrator" AND $actualRank !== "Administrator" AND $actualRank !== "Moderator") {
				switch($points) {
					case ($points < 50): 
						if($actualRank !== $ranks[0]) {
							$this->Db->update("users", array("Rank" => $ranks[0]), $ID_User);
						}
					break;

					case ($points >= 50 and $points < 100):
						if($actualRank !== $ranks[1]) {
							$this->Db->update("users", array("Rank" => $ranks[1]), $ID_User);
						}
					break;

					case ($points >= 100 and $points < 200):
						if($actualRank !== $ranks[2]) {
							$this->Db->update("users", array("Rank" => $ranks[2]), $ID_User);
						}
					break;

					case ($points >= 200 and $points < 350):
						if($actualRank !== $ranks[3]) {
							$values = "Rank = '$ranks[3]'";
							$this->Db->values($values);
							$this->Db->save($ID_User);
						}
					break;
					
					case ($points >= 200 and $points < 350):
						if($actualRank !== $ranks[3]) {
							$this->Db->update("users", array("Rank" => $ranks[3]), $ID_User);
						}
					break;
					
					case ($points >= 350 and $points < 550):
						$this->Db->update("users", array("Rank" => $ranks[4]), $ID_User);
					break;

					case ($points >= 550 and $points < 800):
						if($actualRank !== $ranks[5]) {
							$this->Db->update("users", array("Rank" => $ranks[5]), $ID_User);
						}
					break;

					case ($points >= 800 and $points < 1100):
						if($actualRank !== $ranks[6]) {
							$this->Db->update("users", array("Rank" => $ranks[6]), $ID_User);
						}
					break;
					
					case ($points > 1100):
						$this->Db->update("users", array("Rank" => $ranks[7]), $ID_User);
					break;
				}
			}
		} else {
			$this->Db->update("users", array("Rank" => $ranks[$rank]), $ID_User);
		}		
	}
	
	public function getLastUsers() {
		return $this->Db->findBySQL("Situation = 'Active' ORDER BY Start_Date DESC LIMIT 10", "users");
	}
	
	public function deleteTopic($ID) {
		$delete = $this->Db->find($ID, "forums_posts");
		
		if($delete) {
			$count = $this->Db->countBySQL("ID_Parent = '$ID' AND Situation = 'Active'", "forums_posts");

			if($count > 0) {
				$replies = $this->Db->findBySQL("ID_Parent = '$ID' AND Situation = 'Active'", "forums_posts");
				
				if($replies) {
					foreach($replies as $reply) {
						$this->Db->update("forums_posts", array("Situation" => "Inactive"), $reply["ID_Post"]);
					}
					
					$this->Db->table("forums"); 
					$this->Db->values("Replies = (Replies) - $count");
					$this->Db->save($delete[0]["ID_Forum"]);
					
					$this->Db->table("users");
					
					foreach($replies as $reply) {
						$this->Db->values("Replies = (Replies) - 1");
						$this->Db->save($reply["ID_User"]);	
					}
				}
				
				$this->Db->update("forums_posts", array("Situation" => "Inactive"), $delete[0]["ID_Post"]);
				
				$this->Db->table("forums");
				$this->Db->values("Topics = (Topics) - 1");
				$this->Db->save($delete[0]["ID_Forum"]);
				
				$this->Db->table("users");
				$this->Db->values("Topics = (Topics) - 1");
				$this->Db->save($delete[0]["ID_User"]);
			} else {
				$this->Db->update("forums_posts", array("Situation" => "Inactive"), $delete[0]["ID_Post"]);
				
				$this->Db->table("forums");
				$this->Db->values("Topics = (Topics) - 1");
				$this->Db->save($delete[0]["ID_Forum"]);
				
				$this->Db->table("users");
				$this->Db->values("Topics = Topics - 1");
				$this->Db->save($delete[0]["ID_User"]);
			}
			
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function deleteReply($ID) {
		$delete = $this->Db->find($ID, "forums_posts");
		
		if($delete) {
			$this->Db->update("forums_posts", array("Situation" => "Inactive"), $delete[0]["ID_Post"]);
			
			$lastID = $this->Db->findBySQL("ID_Parent > '0' AND Situation = 'Active' ORDER BY Start_Date DESC LIMIT 1");
			
			if($lastID) {
				$this->Db->update("forums", array("Last_Reply" => $ID_Last), $delete[0]["ID_Forum"]);
			} else {
				$this->Db->update("forums", array("Last_Reply" => 0), $delete[0]["ID_Forum"]);
			}
			
			$this->Db->table("forums");
			$this->Db->values("Replies = (Replies) - 1");
			$this->Db->save($delete[0]["ID_Forum"]);
				
			$this->Db->table("users");
			$this->Db->values("Replies = (Replies) - 1");
			$this->Db->save($delete[0]["ID_User"]);
				
			return TRUE;
		} else {
			return FALSE;
		}		
	}
}