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
		$this->fieldsPosts = "ID_Post, ID_User, ID_Forum, ID_Parent, Title, Slug, Content, Author, Start_Date, Text_Date, Hour, Visits, Topic, Tags, Language, Situation";

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
            "Situation"   => POST("situation"),
            "Last_Date"	  => ""
		);
	
		$this->data = $this->Data->proccess($data, $validations);

		if(isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function savePost() {
		$this->helper(array("alerts", "time"));
            	
		$data = array(
			"ID_User"     => SESSION("ZanUserID"),
			"ID_Forum"    => (int) POST("forumID"),
			"ID_Parent"   => 0,
            "Title"       => POST("title"),
			"Slug"        => slug(POST("title", "clean")),
			"Content"     => POST("content"),
			"Author" 	  => SESSION("ZanUser"),
			"Start_Date"  => now(4),
			"Text_Date"   => decode(now(2)),
			"Tags" 		  => POST("tags") ? POST("tags") : "",
			"Language"    => whichLanguage(),
            "Situation"   => "Active"
		);
		
		$lastID = $this->Db->insert("forums_posts", $data);
		
		$URL = path("forums/". slug(POST("fname")) ."/". $lastID ."/". $data["Slug"]);

		$json =  array(
			"alert" => getAlert(__("The post has been saved correctly"), "success"),
			"title" => '<a href="'. $URL .'" title="'. stripslashes($data["Title"]) .'">'. stripslashes($data["Title"]) .'</a>',
			"date"  => __("Published") ." ". howLong($data["Start_Date"]) ." ". __("in") ." ". exploding($data["Tags"], "forums/tag/") ." ". __("by") .' <a href="'. path("forums/author/". $data["Author"]) .'">'. $data["Author"] .'</a>',
			"description" => stripslashes($data["Content"])
		);

		echo json($json);
	}
	
	private function save() {
        if($this->getByForum($this->data["Slug"], POST("language"))) {
            return getAlert(__("This forum already exists"), "error", $this->URL);
        } 
        
        $this->Db->insert($this->table, $this->data);
        
        return getAlert(__("The forum has been saved correctly"), "success", $this->URL);
	}
	
	private function edit() {
        $forum = $this->getIDByForum($this->data["Slug"]);
        
        if(!$forum){
            return getAlert(__("The forum does not exist"), "error", $this->URL);
        }
        
        $this->Db->update($this->table, $this->data, POST("ID"));	
		
		return getAlert(__("The forum has been edited correctly"), "success", $this->URL);
	}
	
	public function getByID($ID) {		
		return $this->Db->find($ID, $this->table);
	}
	
	public function getForums($language = "Spanish") {
		return $this->Db->findBySQL("Language = '$language' AND Situation = 'Active'", $this->table);
	}
	
	public function getByForum($slug, $language = "Spanish") {	
		$query = "SELECT muu_forums.ID_Forum, muu_forums.Title AS Forum, muu_forums.Slug AS Forum_Slug, muu_forums_posts.ID_Post, muu_forums_posts.Title, muu_forums_posts.Tags, muu_forums_posts.Slug AS Post_Slug, muu_forums_posts.ID_Parent, muu_forums_posts.Content, muu_forums_posts.Author, muu_forums_posts.Start_Date 
		          FROM muu_forums 
				  INNER JOIN muu_forums_posts ON muu_forums_posts.ID_Forum = muu_forums.ID_Forum
				  WHERE muu_forums.Slug = '$slug' AND muu_forums_posts.Language = '$language' AND muu_forums.Situation = 'Active' AND muu_forums_posts.ID_Parent = 0 ORDER BY ID_Post DESC";
		
		return $this->Db->query($query);
	}

	public function getPost($postID) {
		$query = "SELECT ID_Post, ID_User, ID_Parent, Title, Slug, Content, Author, Start_Date, Tags FROM muu_forums_posts WHERE ID_Post = $postID OR ID_Parent = $postID ORDER BY ID_Parent, ID_Post";
		
		return $this->Db->query($query);		
	}

	public function getIDByForum($slug) {
		return $this->Db->findBy("Slug", $slug, $this->table, $this->fields);
	}

	private function search($search, $field) {
		if($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);	      
		} else {
			return FALSE;
		}
	}

	public function getByTag($tag, $limit = FALSE) {
		$tag = str_replace("-", " ", $tag);
		
		return $this->Db->query("SELECT ". $this->fieldsPosts ." FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1) ORDER BY ID_Post DESC LIMIT ". $limit);
		
	}

	public function count($type = "posts") {
		if($type === "tag") {
			$tag = str_replace("-", " ", segment(2, isLang()));

 	 		$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1) ORDER BY ID_Post DESC LIMIT ". $limit);

 	 		return $count[0]["Total"];
		}
	}
}