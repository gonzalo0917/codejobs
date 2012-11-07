<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Model extends ZP_Load {
	
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
			"title"   	  => "required",
			"description" => "required"
		);
            
        $this->URL = path("forums/". slug(POST("title", "clean")), FALSE, POST("language"));
				
		$data = array(
			"ID_Forum"    => POST("ID"),
            "Title"       => POST("title"),
			"Slug"        => slug(POST("title", "clean")),
			"Description" => POST("description"),
			"Language"    => POST("language"),
            "Situation"   => POST("situation")
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
				$data[$i]["editURL"]     = path("forums/cpanel/edit/". $forum["ID_Forum"]);
				$data[$i]["deleteURL"]   = path("forums/cpanel/trash/". $forum["ID_Forum"]);
				
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
	
	public function getByForum($slug, $language = "Spanish") {	
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
					$dataTopic[$i]["topicURL"]    = path("forums/". $dataForum["Forum_Slug"] ."/new");
					$dataTopic[$i]["replyURL"]    = path("forums/" . $topic["Slug"] ."/". $topic["ID_Post"] ."/new");
					$dataTopic[$i]["editURL"]     = path("forums/" . $topic["Slug"] ."/". $topic["ID_Post"] ."/edit");
					$dataTopic[$i]["deleteURL"]   = path("forums/". $topic["Slug"] ."/". $topic["ID_Post"] ."/delete");
																		
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

						$dataTopic[$i]["Last_URL"] = path("forums/". $topic["Slug"] ."/". $dataTopic[$i]["ID"] ."/page/". $page ."/#bottom");
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
		$this->helper("time");

		$date = now(4);
		$hour = date("H:i:s", $date);
		
		$lastTopic = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Parent = 0 AND Situation = 'Active' ORDER BY Start_Date DESC LIMIT 1", "forums_posts");
		
		if($lastTopic) {
			$time = ($lastTopic) ? $date - $lastTopic[0]["Start_Date"] : 20;
		} else {
			$time = 20;
		}

		if($time > 5) { 
			$data = array(
				"ID_Forum"   => POST("ID_Forum"),
				"ID_User" 	 => SESSION("ZanUserID"), 
				"Title" 	 => POST("title", "decode", "escape"),
				"Slug"		 => slug(POST("title", "clean")),
				"Content"	 => POST("content", "decode", FALSE),
				"Author"	 => SESSION("ZanUser"),
				"Start_Date" => $date,
				"Text_Date"	 => now(2),
				"Hour"       => $hour,
				"Topic"		 => 1
			);
			
			$lastID = $this->Db->insert("forums_posts", $data);
			
			$this->Db->updateBySQL("forums", "Topics = (Topics) + 1 WHERE ID_Forum = '$lastID'");
		} else { 
			$data = FALSE;
		}
		
		if($data) {
			if(POST("tweet") === "Yes") {
				if(SESSION("ZanUserMethod") === "twitter") {
					$this->Twitter_Model = $this->model("Twitter_Model");

					$tweet = __("I posted on") ." ". $title;

					$this->Twitter_Model->publish($tweet, POST("URL") . $data[0]["Last_ID"]);
				}
			}
			
			return $lastID;
		} 
		
		return FALSE;
	}
	
	public function editTopic() {
		$date  = now(4);
		$title = POST("title", "decode", "escape");

		$data = array(
			"Title"   	 => $title,
			"Content" 	 => POST("content", "decode", FALSE),
			"Slug"	  	 => slug($title),
			"Start_Date" => $date,
			"Text_Date"  => now(2),
			"Hour"		 => date("H:i:s", $date)
		);

		$update = $this->Db->update("forums_posts", $data, POST("ID_Post"));
		
		$this->Db->updateBySQL("forums_posts", "Title = 'Re: $title' WHERE ID_Parent = '". POST("ID_Post") ."'");
		
		return $update;
	}
	
	public function countRepliesByTopic($ID) {
		return $this->Db->countBySQL("ID_Parent = '$ID' AND Situation = 'Active'", "forums_posts");
	}
	
	public function getPage($ID) {
		$total = $this->countRepliesByTopic($ID);
		$page  = $total / _maxLimit;
		
		return is_float($page) ? (intval($page) + 1) : $page;
	}
	
	public function addVisit($ID) {
		return $this->Db->updateBySQL("forums_posts", "Visits = (Visits) + 1 WHERE ID_Post = '$ID'");
	}
	
	public function getByTopic($ID, $limit) {	
		$topic = $this->Db->query("SELECT ID_Post, muu_users.ID_User, ID_Forum, ID_Parent, muu_forums_posts.Title, Slug, Content, Author, muu_forums_posts.Start_Date, Username, Website, Avatar, Country, Sign FROM muu_forums_posts
								   INNER JOIN muu_users ON muu_users.ID_User = muu_forums_posts.ID_User 
								   WHERE ID_Post = $ID AND muu_forums_posts.Situation = 'Active' AND ID_Parent = 0");

		$replies = $this->Db->query("SELECT ID_Post, muu_users.ID_User, ID_Forum, ID_Parent, muu_forums_posts.Title, Slug, Content, Author, muu_forums_posts.Start_Date, Username, Website, Avatar, Country, Sign FROM muu_forums_posts 
									 INNER JOIN muu_users ON muu_users.ID_User = muu_forums_posts.ID_User 
									 WHERE ID_Parent = '$ID' AND muu_forums_posts.Situation = 'Active' ORDER BY ID_Post LIMIT $limit");

		if($topic) {
			$topic[0]["replyURL"]  = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/new");
			$topic[0]["editURL"]   = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/edit");
			$topic[0]["deleteURL"] = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/delete");
		}
		
		if($replies) {
			$i = 0;

			foreach($replies as $reply) {
				if(segment(3, isLang()) === "page" and segment(4, isLang()) > 0) {
					$page = segment(4, isLang());

					$replies[$i]["deleteURL"] = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/delete/". $reply["ID_Post"] ."/". $page);
					$replies[$i]["editURL"]   = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/edit/". $reply["ID_Post"] ."/". $page);
				} else {
					$replies[$i]["deleteURL"] = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/delete/". $reply["ID_Post"]);
					$replies[$i]["editURL"]   = path("forums/". $topic[0]["Slug"] ."/". $topic[0]["ID_Post"] ."/edit/". $reply["ID_Post"]);
				}
				
				$i++;
			}
		}
		
		$data["topic"]   = $topic;
		$data["replies"] = $replies;

		return $data;
	}
	
	public function getTopicByID($ID) {
		return $this->Db->findBySQL("ID_Post = '$ID'", "forums_posts");
	}
	
	public function setReply() {
		$this->helper("time");
		
		$date = now(4);
		
		$lastTopic = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND ID_Parent > 0 AND Situation = 'Active' ORDER BY Start_Date DESC LIMIT 1", "forums_posts");
		
		$time = ($lastTopic) ? $date - $lastTopic[0]["Start_Date"] : 10;
		
		if($time > 5) {
			$data = array(
				"ID_Forum"   => POST("ID_Forum"),
				"ID_User" 	 => SESSION("ZanUserID"), 
				"ID_Parent"	 => POST("ID_Post"),
				"Title" 	 => POST("title", "decode", "escape"),
				"Slug"		 => slug(POST("title", "decode", "escape")),
				"Content"	 => POST("content", "decode", FALSE),
				"Author"	 => SESSION("ZanUser"),
				"Start_Date" => $date,
				"Text_Date"	 => decode(now(2)),
				"Hour"       => date("H:i:s", $date),
				"Topic"		 => 1
			);
			
			$lastID = $this->Db->insert("forums_posts", $data);

			$this->Db->updateBySQL("forums", "Replies = (Replies) + 1, Last_Reply = '$lastID' WHERE ID_Forum = '". POST("ID_Forum") ."'");
		} else { 
			$data = FALSE;
		}
		
		return ($data) ? $lastID : FALSE;
	}
	
	public function editReply() {
		$date = now(4);

		$data = array(
			"Title"   	 => POST("title", "decode", "escape"),
			"Content" 	 => POST("content", "decode", FALSE),
			"Slug"	  	 => slug($title),
			"Start_Date" => $date,
			"Text_Date"  => now(2),
			"Hour"		 => date("H:i:s", $date)
 		);

 		return $this->Db->update("forums_posts", $data, POST("ID_Post"));
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
			if($avatar[0]["Avatar"] !== "") {
				return path("www/lib/files/images/users/" .$avatar[0]["Avatar"], TRUE);
			} elseif($avatar[0]["Avatar"] === "") {
				return path("www/lib/files/images/users/default.png", TRUE);
			} 
		} 

		return FALSE;
	}
	
	public function addUserTopic() {
		return (SESSION("ZanUserID")) ? $this->Db->updateBySQL("users", "Topics = (Topics) + 1 WHERE ID_User = '". SESSION("ZanUserID") ."'") : FALSE;
	}
	
	public function addUserReply() {
		return (SESSION("ZanUserID")) ? $this->Db->updateBySQL("users", "Replies = (Replies) + 1 WHERE ID_User = '". SESSION("ZanUserID") ."'") : FALSE;
	}
	
	public function getStatistics() { 
		return (SESSION("ZanUserID")) ? $this->Db->find(SESSION("ZanUserID"), "users") : FALSE;
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
					
					$this->Db->updateBySQL("forums", "Replies = (Replies) - $count WHERE ID_Forum = '". $delete[0]["ID_Forum"] ."'");
					
					foreach($replies as $reply) {
						$this->Db->updateBySQL("users", "Replies = (Replies) - 1 WHERE ID_User = '". $reply["ID_User"] ."'");
					}
				}
				
				$this->Db->update("forums_posts", array("Situation" => "Inactive"), $delete[0]["ID_Post"]);
				$this->Db->updateBySQL("forums", "Topics = (Topics) - 1 WHERE ID_Forum = '". $delete[0]["ID_Forum"] ."'");
				$this->Db->updateBySQL("users", "Topics = (Topics) - 1 WHERE ID_User = '". $delete[0]["ID_User"] ."'");
			} else {
				$this->Db->update("forums_posts", array("Situation" => "Inactive"), $delete[0]["ID_Post"]);
				$this->Db->updateBySQL("forums", "Topics = (Topics) - 1 WHERE ID_Forum = '". $delete[0]["ID_Forum"] ."'");
				$this->Db->updateBySQL("users", "Topics = (Topics) - 1 WHERE ID_User = '". $delete[0]["ID_User"] ."'");
			}
			
			return TRUE;
		} 
		
		return FALSE;
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
			
			$this->Db->updateBySQL("forums", "Replies = (Replies) - 1 WHERE ID_Forum = '". $delete[0]["ID_Forum"] ."'");
			$this->Db->updateBySQL("users", "Replies = (Replies) - 1 WHERE ID_User = '". $reply["ID_User"] ."'");
				
			return TRUE;
		} 

		return FALSE;	
	}
}