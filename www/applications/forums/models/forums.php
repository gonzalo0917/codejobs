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

		return $URL;
	}

	public function updatePost() {
		$this->helper(array("alerts", "time"));
        
        $id = POST("postID");

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

		$this->Db->update("forums_posts", $data, $id);
		
		$URL = path("forums/". slug(POST("fname")) ."/". $id ."/". $data["Slug"]);

		return $URL;
	}
	
	private function save() {
        if($this->getByForum($this->data["Slug"], POST("language"))) {
            return getAlert(__("This forum already exists"), "error", $this->URL);
        } 
        
        $this->Db->insert($this->table, $this->data);
        
        return getAlert(__("The forum has been saved correctly"), "success", $this->URL);
	}
	
	private function edit() {
		if($this->Db->update($this->table, $this->data, POST("ID"))) {
            return getAlert(__("The work has been edit correctly"), "success");
        }
        
        return getAlert(__("Update error"));
	}
	
	public function deletePost($postID) {
		$this->Db->delete($postID, "muu_forums_posts");

		$query = "DELETE FROM muu_forums_posts WHERE ID_Parent = $postID ";

		return $this->Db->query($query);
	}

	public function editPost($postID) {
		if($this->Db->update($this->table, $this->data, $postID)) {
            return getAlert(__("The work has been edit correctly"), "success");
        }
        
        return getAlert(__("Update error"));
	}

	public function getByID($ID) {		
		return $this->Db->find($ID, $this->table);
	}
	
	public function getForums($language = "Spanish") {
		return $this->Db->findBySQL("Language = '$language' AND Situation = 'Active'", $this->table);
	}
	
	public function getByForum($slug, $language = "Spanish", $limit = FALSE) {	
		$query = "SELECT muu_forums.ID_Forum, muu_forums.Title AS Forum, muu_forums.Slug AS Forum_Slug, muu_forums_posts.ID_Post, muu_forums_posts.Title, muu_forums_posts.Tags, muu_forums_posts.Slug AS Post_Slug, muu_forums_posts.ID_Parent, muu_forums_posts.Content, muu_forums_posts.Author, muu_forums_posts.Start_Date 
		          FROM muu_forums 
				  INNER JOIN muu_forums_posts ON muu_forums_posts.ID_Forum = muu_forums.ID_Forum
				  WHERE muu_forums.Slug = '$slug' AND muu_forums_posts.Language = '$language' AND muu_forums.Situation = 'Active' AND muu_forums_posts.ID_Parent = 0 ORDER BY ID_Post DESC LIMIT ". $limit;
		
		return $this->Db->query($query);
	}

	public function getPost($postID) {
		$query = "SELECT ID_Post, ID_User, ID_Parent, Title, Slug, Content, Author, Start_Date, Tags FROM muu_forums_posts WHERE ID_Post = $postID OR ID_Parent = $postID ORDER BY ID_Parent, ID_Post";
		
		return $this->Db->query($query);		
	}

	public function getPostToEdit($postID) {
		$query = "SELECT ID_Post, ID_Forum, ID_User, ID_Parent, Title, Slug, Content, Author, Start_Date, Tags FROM muu_forums_posts WHERE ID_Post = $postID AND ID_Parent = 0 ";
		
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

	public function getByAuthor($author, $limit = FALSE) {
		$author = str_replace("-", " ", $author);
		
		return $this->Db->query("SELECT ". $this->fieldsPosts ." FROM muu_forums_posts WHERE Author = '$author' AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1) ORDER BY ID_Post DESC LIMIT ". $limit);
	}

	public function getByAuthorTag($author, $tag, $limit) {
		$tag = str_replace("-", " ", $tag);

		return $this->Db->query("SELECT ". $this->fieldsPosts ." FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Author = '$author' AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1) ORDER BY ID_Post DESC LIMIT ". $limit);
	}

	public function getByTag($tag, $limit = FALSE) {

		$tag  = str_replace("-", " ", $tag);
		$slug = segment(1, isLang());
		
		return $this->Db->query("SELECT muu_forums.ID_Forum, muu_forums.Title AS Forum, muu_forums_posts.ID_Post, muu_forums_posts.Title, muu_forums_posts.Tags, muu_forums_posts.Slug, muu_forums_posts.ID_Parent, muu_forums_posts.Content, muu_forums_posts.Author, muu_forums_posts.Start_Date 
								 FROM muu_forums 
								 INNER JOIN muu_forums_posts ON muu_forums_posts.ID_Forum = muu_forums.ID_Forum
								 WHERE muu_forums.Slug = '$slug' AND (muu_forums_posts.Title LIKE '%$tag%' OR muu_forums_posts.Content LIKE '%$tag%' OR muu_forums_posts.Tags LIKE '%$tag%') AND muu_forums_posts.Language = '$this->language' AND muu_forums.Situation = 'Active' AND muu_forums_posts.ID_Parent = 0 ORDER BY ID_Post DESC LIMIT ". $limit);	
	}

	public function count($type = "posts") {
		if ($type = "posts") {

			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");

			return $count[0]["Total"];
		} elseif($type === "tag") {
			$tag = str_replace("-", " ", segment(3, isLang()));

			$a = "SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)";

 	 		$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");

 	 		return $count[0]["Total"];
		} elseif($type === "author") {
			$author = str_replace("-", " ", segment(3, isLang()));

			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$author%' OR Content LIKE '%$author%' OR Author LIKE '%$author%') AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");

			return  $count[0]["Total"];
		} elseif($type === "author-tag") {
			$author = segment(3, isLang());

			$tag  = str_replace("-", " ", segment(5, isLang()));
			
			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content Like '%$tag%' OR Tags Like '%$tag%') AND Author = '$author' AND (Situation = 'Active' OR Situation = 'Pending') AND Language = '$this->language' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");

			return $count[0]["Total"];
		} 
	}

	public function saveComment($fid, $content) {
		$this->helper(array("alerts", "time"));

		if($fid and $content) {
			$data = array(
				"ID_User" => SESSION("ZanUserID"),
				"ID_Parent" => $fid, 
				"Title" => NULL,
				"Slug" => NULL,
				"Text_Date" => decode(now(2)),
				"Tags" => NULL,
				"Content" => $content,
				"Author" => SESSION("ZanUser"),
				"Start_Date" => now(4), 
				"Topic" => 0,
				"Language" => $this->language,
				"Situation" => "Active"
			);			



			if($this->Db->insert("forums_posts", $data)) {
				
				$content = BBCode($data["Content"]);

				$json =  array(
					"alert" => getAlert(__("The comment has been saved correctly"), "success"),
					"date"  => '<a href="'. path("forums/author/". $data["Author"]) .'">'. $data["Author"] .'</a> '. __("Published") ." ". howLong($data["Start_Date"]),
					"content" => stripslashes($content)
				);

				echo json($json);

			} else {			
				return FALSE;
			}
		}
	}
}