<?php
<<<<<<< HEAD
=======
/**
 * Access from index.php:
 */
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Forums_Model extends ZP_Load
{
	public function __construct() {
		$this->Db = $this->db();
        $this->language = whichLanguage();
		$this->table = "forums";
		$this->fields = "ID_Forum, Title, Slug, Description, Topics, Replies, Last_Reply, Last_Date, Language, Situation";
		$this->fieldsPosts = "ID_Post, ID_User, ID_Forum, ID_Parent, Title, Slug, Content, Author, Start_Date, Text_Date, Hour, Visits, Topic, Tags, Language, Situation";
		$this->Data = $this->core("Data");
		$this->Data->table($this->table);
	}
<<<<<<< HEAD

	public function cpanel($action, $limit = null, $order = "Language DESC", $search = null, $field = null, $trash = false)
	{
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
	
=======
	
	public function cpanel($action, $limit = null, $order = "Language DESC", $search = null, $field = null, $trash = false) {
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
			if ($validation) {
				return $validation;
			}
		}
<<<<<<< HEAD

		if ($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif ($action === "edit") {
			return $this->edit();
=======
		
		if ($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif ($action === "edit") {
			return $this->edit();															
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		} elseif ($action === "save") {
			return $this->save();
		} elseif ($action === "search") {
			return $this->search($search, $field);
		}
	}
<<<<<<< HEAD

	private function all($trash, $order, $limit)
	{
=======
	
	private function all($trash, $order, $limit) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
        return ($trash) ? $this->Db->findBy("Situation", "Deleted", $this->table, $this->fields, null, $order, $limit) : $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $this->fields, null, $order, $limit);		
	}

	private function editOrSave()
	{
        $validations = array(
			"exists" => array(
				"Year" => date("Y"),
				"Month" => date("m"),
				"Day" => date("d"),
				"Language" => POST("language")
			),
			"title" => "required",
			"description" => "required"
		);
<<<<<<< HEAD

        $this->URL = path("forums/". slug(POST("title", "clean")), false, POST("language"));
=======
            
        $this->URL = path("forums/". slug(POST("title", "clean")), false, POST("language"));
				
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$data = array(
			"ID_Forum" => POST("ID"),
            "Title" => POST("title"),
			"Slug" => slug(POST("title", "clean")),
			"Description" => POST("description"),
			"Language" => POST("language"),
            "Situation" => POST("situation"),
            "Last_Date" => ""
		);

		$this->data = $this->Data->proccess($data, $validations);

		if (isset($this->data["error"])) {
			return $this->data["error"];
		}
	}

	public function savePost()
	{
		$this->helper(array("alerts", "time"));

		if (substr(SESSION("ZanUserAvatar"), 0, 4) === "http"){
			$avatar = SESSION("ZanUserAvatar");
		} else {
			$avatar = path("www/lib/files/images/users/". SESSION("ZanUserAvatar"), true);
		}

		$data = array(
			"ID_User" => SESSION("ZanUserID"),
			"ID_Forum" => (int) POST("forumID"),
			"ID_Parent" => 0,
			"Forum_Name" => POST("fname"),
            "Title" => POST("title"),
			"Slug" => slug(POST("title", "clean")),
			"Content" => POST("content", "clean"),
			"Author" => SESSION("ZanUser"),
			"Avatar" => $avatar,
			"Last_Reply" => now(4),
			"Start_Date" => now(4),
			"Text_Date" => decode(now(2)),
			"Tags" => POST("tags") ? POST("tags") : "",
			"Language" => whichLanguage(),
            "Situation" => "Active"
		);

		$lastID = $this->Db->insert("forums_posts", $data);
		$URL = path("forums/". slug(POST("fname", "clean")) ."/". $lastID ."/". $data["Slug"]);
		return $URL;
	}

	public function updatePost()
	{
		$this->helper(array("alerts", "time"));
        $id = POST("postID");
		$data = array(
			"ID_User" => SESSION("ZanUserID"),
			"ID_Forum" => (int) POST("forumID"),
			"ID_Parent" => 0,
            "Title" => POST("title"),
			"Slug" => slug(POST("title", "clean")),
			"Content" => POST("content"),
			"Author" => SESSION("ZanUser"),
			"Start_Date" => now(4),
			"Text_Date" => decode(now(2)),
			"Tags" => POST("tags") ? POST("tags") : "",
			"Language" => whichLanguage(),
            "Situation" => "Active"
		);

		$this->Db->update("forums_posts", $data, $id);
		$URL = path("forums/". slug(POST("fname")) ."/". $id ."/". $data["Slug"]);
		return $URL;
	}

	public function updateComment()
	{
		$this->helper(array("alerts", "time"));
        $id = POST("postID");
        $forumID = POST("forumID");
		$data = array(
			"Content" => POST("content"),
			"Text_Date" => decode(now(2))
		);

		$this->Db->update("forums_posts", $data, $id);
		$URL = path("forums/". slug(POST("fname")) ."/". $forumID ."/#id". $id);
		return $URL;
	}

<<<<<<< HEAD
	private function save()
	{
=======

	private function save() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
        if ($this->getByForum($this->data["Slug"], POST("language"))) {
            return getAlert(__("This forum already exists"), "error", $this->URL);
        } 

        $this->Db->insert($this->table, $this->data);
        return getAlert(__("The forum has been saved correctly"), "success", $this->URL);
	}
<<<<<<< HEAD

	private function edit()
	{
=======
	
	private function edit() {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($this->Db->update($this->table, $this->data, POST("ID"))) {
            return getAlert(__("The work has been edit correctly"), "success");
        }

        return getAlert(__("Update error"));
	}

	public function deletePost($postID)
	{
		$this->Db->delete($postID, "muu_forums_posts");
		$query = "DELETE FROM muu_forums_posts WHERE ID_Parent = $postID ";
		return $this->Db->query($query);
	}

<<<<<<< HEAD
	public function editPost($postID)
	{
=======
	public function editPost($postID) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		if ($this->Db->update($this->table, $this->data, $postID)) {
            return getAlert(__("The work has been edit correctly"), "success");
        }

        return getAlert(__("Update error"));
	}

	public function getByID($ID)
	{
		return $this->Db->find($ID, $this->table);
	}

	public function getForums($language = "Spanish")
	{
		return $this->Db->findBySQL("Language = '$language' AND Situation = 'Active'", $this->table);
	}
<<<<<<< HEAD

	public function getByForum($slug, $language = "Spanish", $limit = false)
	{
		$query = "SELECT muu_forums.ID_Forum, muu_forums.Title AS Forum, muu_forums.Slug AS Forum_Slug, 
					muu_forums_posts.ID_Post, muu_forums_posts.ID_User, muu_forums_posts.Forum_Name, muu_forums_posts.Title, muu_forums_posts.Tags, muu_forums_posts.Slug 
					AS Post_Slug, muu_forums_posts.ID_Parent, muu_forums_posts.Last_Author, muu_forums_posts.Content, muu_forums_posts.Author, muu_forums_posts.Start_Date 
=======
	
	public function getByForum($slug, $language = "Spanish", $limit = false) {	
		$query = "SELECT muu_forums.ID_Forum, muu_forums.Title AS Forum, muu_forums.Slug AS Forum_Slug, muu_forums_posts.ID_Post, muu_forums_posts.ID_User, muu_forums_posts.Forum_Name, muu_forums_posts.Title, muu_forums_posts.Tags, muu_forums_posts.Slug AS Post_Slug, muu_forums_posts.ID_Parent, muu_forums_posts.Last_Author, muu_forums_posts.Content, muu_forums_posts.Author, muu_forums_posts.Start_Date 
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		          FROM muu_forums 
				  INNER JOIN muu_forums_posts ON muu_forums_posts.ID_Forum = muu_forums.ID_Forum
				  WHERE muu_forums.Slug = '$slug' AND muu_forums_posts.Language = '$language' AND muu_forums.Situation = 'Active' 
				  AND muu_forums_posts.ID_Parent = 0 ORDER BY muu_forums_posts.Last_Reply DESC LIMIT ". $limit;
		$data = $this->Db->query($query);

		if ($data) {
			return $data;
		} else {
			$query = "SELECT ID_Forum, Title, Slug
		          FROM muu_forums 
				  WHERE Slug = '$slug' AND Language = '$language' AND Situation = 'Active'";
		  	return $this->Db->query($query);
		}
	}

	public function getPost($postID)
	{
		$query = "SELECT ID_Post, ID_User, ID_Parent, Title, Slug, Content, Author, Avatar, Start_Date, Tags 
		FROM muu_forums_posts WHERE ID_Post = $postID OR ID_Parent = $postID ORDER BY ID_Parent, ID_Post";
		return $this->Db->query($query);
	}

	public function getPostToEdit($postID)
	{
		$query = "SELECT ID_Post, ID_Forum, ID_User, ID_Parent, Title, Slug, Content, Author, Start_Date, Tags 
		FROM muu_forums_posts WHERE ID_Post = $postID AND ID_Parent = 0 ";
		return $this->Db->query($query);
	}

	public function getCommentToEdit($postID)
	{
		$query = "SELECT ID_Post, ID_Forum, ID_User, ID_Parent, Title, Slug, Content, Author, Start_Date, Tags 
		FROM muu_forums_posts WHERE ID_Post = $postID";
		return $this->Db->query($query);
	}

	public function getForumBySlug($slug)
	{
		return $this->Db->findBy("Slug", $slug, $this->table, $this->fields);
	}

<<<<<<< HEAD
	private function search($search, $field)
	{
		if ($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : 
			$this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);
=======
	private function search($search, $field) {
		if ($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);	      
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		} else {
			return false;
		}
	}

<<<<<<< HEAD
	public function getByAuthor($author, $limit = false)
	{
=======
	public function getByAuthor($author, $limit = false) {
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$author = str_replace("-", " ", $author);
		return $this->Db->query("SELECT ". $this->fieldsPosts ." FROM muu_forums_posts WHERE Author = '$author' 
			AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 
			AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1) 
			ORDER BY ID_Post DESC LIMIT ". $limit);
	}

	public function getByAuthorTag($author, $tag, $limit)
	{
		$tag = str_replace("-", " ", $tag);
		return $this->Db->query("SELECT ". $this->fieldsPosts ." FROM muu_forums_posts 
			WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Author = '$author' 
			AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 
			AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1) 
			ORDER BY ID_Post DESC LIMIT ". $limit);
	}

<<<<<<< HEAD
	public function getByTag($tag, $limit = false)
	{
		$tag = str_replace("-", " ", $tag);
=======
	public function getByTag($tag, $limit = false) {

		$tag  = str_replace("-", " ", $tag);
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		$slug = segment(1, isLang());
		return $this->Db->query("SELECT muu_forums.ID_Forum, muu_forums.Title AS Forum, muu_forums_posts.ID_Post, 
								muu_forums_posts.Title, muu_forums_posts.Tags, muu_forums_posts.Slug, muu_forums_posts.ID_Parent, 
								muu_forums_posts.Content, muu_forums_posts.Author, muu_forums_posts.Start_Date 
								 FROM muu_forums 
								 INNER JOIN muu_forums_posts ON muu_forums_posts.ID_Forum = muu_forums.ID_Forum
								 WHERE muu_forums.Slug = '$slug' AND (muu_forums_posts.Title LIKE '%$tag%' OR muu_forums_posts.Content 
								 LIKE '%$tag%' OR muu_forums_posts.Tags LIKE '%$tag%') AND muu_forums_posts.Language = '$this->language' 
								 AND muu_forums.Situation = 'Active' AND muu_forums_posts.ID_Parent = 0 ORDER BY ID_Post DESC LIMIT ". $limit);
	}

	public function count($type = "posts")
	{
		if ($type = "posts") {

			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE Language = '$this->language' 
				AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");
			return $count[0]["Total"];
		} elseif ($type === "tag") {
			$tag = str_replace("-", " ", segment(3, isLang()));
			$a = "SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') 
				 AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums 
				 WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)";
 	 		$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') 
 	 			 	 AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");
 	 		return $count[0]["Total"];
		} elseif ($type === "author") {
			$author = str_replace("-", " ", segment(3, isLang()));
<<<<<<< HEAD
			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$author%' OR Content LIKE '%$author%' OR Author LIKE '%$author%') 
					 AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");
			return $count[0]["Total"];
=======

			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$author%' OR Content LIKE '%$author%' OR Author LIKE '%$author%') AND Language = '$this->language' AND Situation = 'Active' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");

			return  $count[0]["Total"];
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
		} elseif ($type === "author-tag") {
			$author = segment(3, isLang());
			$tag = str_replace("-", " ", segment(5, isLang()));
			$count = $this->Db->query("SELECT COUNT(*) AS Total FROM muu_forums_posts WHERE (Title LIKE '%$tag%' OR Content Like '%$tag%' OR Tags Like '%$tag%') AND Author = '$author' 
				AND (Situation = 'Active' OR Situation = 'Pending') AND Language = '$this->language' AND ID_Parent = 0 AND ID_Forum = (SELECT ID_Forum FROM muu_forums WHERE Slug = '". segment(1, isLang()) ."' LIMIT 1)");
			return $count[0]["Total"];
		} 
	}

	public function saveComment($fid, $content, $fname)
	{
		$this->helper(array("alerts", "time"));
		$now = now(4);
		$author = SESSION("ZanUser");

		if (substr(SESSION("ZanUserAvatar"), 0, 4) === "http"){
			$avatar = SESSION("ZanUserAvatar");
		} else {
			$avatar = path("www/lib/files/images/users/". SESSION("ZanUserAvatar"), true);
		}

		if ($fid and $content) {
			$data = array(
				"ID_User" => SESSION("ZanUserID"),
				"ID_Parent" => $fid, 
				"Title" => null,
				"Slug" => null,
				"Text_Date" => decode(now(2)),
				"Tags" => null,
				"Content" => $content,
				"Author" => $author,
				"Avatar" => $avatar,
				"Start_Date" => $now, 
				"Topic" => 0,
				"Language" => $this->language,
				"Situation" => "Active"
			);

			$lastID = $this->Db->insert("forums_posts", $data);

			if ($lastID) {
				$this->Db->updateBySQL("forums_posts", "Last_Reply = '$now', Last_Author = '$author' WHERE ID_Post = '$fid'");
				$content = $data["Content"];
				$urlEdit = path("forums/". $fname ."/editComment/". $lastID);
				$urlDelete = path("forums/". $fname ."/delete/". $lastID);
				$json = array(
					"alert" => getAlert(__("The comment has been saved correctly"), "success"),
					"date" => '<a href="'. path("forums/". $fname ."/author/". $data["Author"]) .'">'. $data["Author"] .'</a> '. __("Published") ." ". howLong($data["Start_Date"]),
					"content" => stripslashes($content),
					"edit" => $urlEdit,
					"delete" => $urlDelete
				);

				echo json_encode($json);
<<<<<<< HEAD
			} else {
=======
			} else {			
>>>>>>> 8019ddbc809b968b93044ebed6ad1d0df16d1d63
				return false;
			}
		}
	}
}