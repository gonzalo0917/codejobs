<?php
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Blog_Model extends ZP_Load 
{
	
	public function __construct() 
	{
		$this->Db = $this->db();
		$this->language = whichLanguage();
		$this->table = "blog";
		$this->fields = "ID_Post, ID_User, Title, Slug, Content, Tags, Author, Start_Date, Year, Month, Day, Views, 
						 Image_Mural, Image_Thumbnail, Image_Small, Image_Medium, Image_Original, Comments, 
						 Enable_Comments, Language, Display_Bio, Pwd, Buffer, Code, Situation";
		
		$this->Data = $this->core("Data");
		$this->Data->table($this->table);
	}

	public function getRSS() 
	{	
		return $this->Db->findBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields, null, "ID_Post DESC", MAX_LIMIT);
	}
	
	public function cpanel($action, $limit = null, $order = "Language DESC", $search = null, $field = null, $trash = false)
	{
		if ($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if ($validation) {
				return $validation;
			}
		}
		
		if ($action === "all") {
			return $this->all($trash, "ID_Post DESC", $limit);
		} elseif ($action === "edit") {
			return $this->edit();															
		} elseif ($action === "save") {
			return $this->save();
		} elseif ($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit, $own = false) 
	{	
		$fields = "ID_Post, Title, Author, Views, Start_Date, Year, Month, Day, Slug, Language, Situation";

		if (!$trash) {
			if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
				return $this->Db->findBySQL("Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			} else { 
				return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		} else {
			if (SESSION("ZanUserPrivilegeID") == 1 and !$own) {
				return $this->Db->findBy("Situation", "Deleted", $this->table, $fields, null, $order, $limit);
			} else {
			 	return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, $fields, null, $order, $limit);
			}
		}
	}
	
	private function editOrSave($action) 
	{
		if ($action === "save") {
			$validations = array(
				"title" => "required",
				"content" => "required"
			);
		} else {
			$validations = array(				
				"title" => "required",
				"content" => "required"
			);
		}
		
		$lang = getLang(POST("language"));
		$this->helper(array("alerts", "time", "files"));
		$dir = "www/lib/files/images";

		$this->Files = $this->core("Files");
		$this->postImage = $this->Files->uploadImage($dir ."/blog/", "image", "resize", true, true, true, false, true);
		$this->postMural = $this->Files->uploadImage($dir ."/mural/", "mural", "mural");
		
		if ($action === "edit") {
			$this->post = $this->Db->find(POST("ID"), $this->table);

			$currentMural = $this->post[0]["Image_Mural"];
			$currentOriginalImg = $this->post[0]["Image_Original"];
			$currentSmallImg = $this->post[0]["Image_Small"];
			$currentMediumImg = $this->post[0]["Image_Medium"];
			$currentThumbnailImg = $this->post[0]["Image_Thumbnail"];
		} 

        if (is_array($this->postMural)) {
        	return getAlert(__($this->postMural["alert"]));
        }
		
		if (POST("delete_mural") === "on") {
			$this->Files->deleteFiles(array($currentMural));
			$this->postMural = false;
		} else {
			if (!$this->postMural and $action == "edit") {
				$this->postMural = $currentMural;
			} elseif ($this->postMural and $action == "edit") {
				$this->Files->deleteFiles(array($currentMural));
			}
		}
		
		if (POST("delete_image") === "on") {
			$this->Files->deleteFiles(array($currentOriginalImg, $currentSmallImg, $currentMediumImg, $currentThumbnailImg));
			$this->postImage = null;
		} else {
			if (!$this->postImage and $action == "edit") {
				$this->postImage["original"]  = $currentOriginalImg;
				$this->postImage["small"] = $currentSmallImg;
				$this->postImage["medium"] = $currentMediumImg;
				$this->postImage["thumbnail"] = $currentThumbnailImg;
			} elseif ($this->postImage and $action == "edit") {
				$this->Files->deleteFiles(array($currentOriginalImg, $currentSmallImg, $currentMediumImg, $currentThumbnailImg));
			}
		}

		$data = array(
			"Slug" => slug(POST("title", "clean")),
			"Content" => decode(POST("content", "clean")),
			"Author" => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Image_Original" => isset($this->postImage["original"]) ? $this->postImage["original"] : null,
			"Image_Small" => isset($this->postImage["small"])  ? $this->postImage["small"]  : null,
			"Image_Mural" => isset($this->postMural) ? $this->postMural : null,
			"Image_Medium" => isset($this->postImage["medium"]) ? $this->postImage["medium"] : null,
			"Image_Thumbnail" => isset($this->postImage["thumbnail"]) ? $this->postImage["thumbnail"] : null,
			"Pwd" => (POST("pwd")) ? POST("pwd", "encrypt") : '',			
			"Tags" => POST("tags"),
			"Buffer" => !POST("buffer") ? 0 : POST("buffer"),
			"Code" => !POST("code") ? code(10) : POST("code"),
		);

		if ($action === "save") {
			$data["ID_User"] = SESSION("ZanUserID");
			$data["Start_Date"] = now(4);
			$data["Text_Date"] = decode(now(2));
			$data["Year"] = date("Y");
			$data["Month"] = date("m");
			$data["Day"] = date("d");
		} else {
			$data["Modified_Date"] = now(4);
		}

		$this->Data->ignore(array(
			"delete_image", "delete_mural" , "temp_title", "temp_tags", "temp_content", "editor", "categories", "tags",
			"mural_exists", "mural", "pwd", "category", "language_category", "application", "mural_exist")
		);

		$this->data = $this->Data->process($data, $validations);
		
		if (isset($this->data["error"])) {
			return $this->data["error"];
		}
	}
	
	private function save() {	
		$data = $this->Db->findBySQL("Code = '". POST("code") ."' AND Situation = 'Draft'", $this->table);
		
		$insertID = (!$data) ? $this->Db->insert($this->table, $this->data) : $this->Db->update($this->table, $this->data, $data[0]["ID_Post"]);

		$this->Cache = $this->core("Cache");
		$this->Cache->removeAll("blog");
		
		$this->Users_Model = $this->model("Users_Model");
		$this->Users_Model->setCredits(1, 3);
			
		return getAlert(__("The post has been saved correctly"), "success");
	}

	public function saveDraft() {
		$this->helper(array("alerts", "time"));
		
		$postID	= POST("postID");
		$data = ($postID > 0) ? $this->Db->find($postID, $this->table) : $this->Db->findBySQL("Code = '". POST("code") ."' AND Situation = 'Draft'", $this->table);		

		if ($data) {						
			$postID = $data[0]["ID_Post"];

			$data = array(				
				"Title"	=> POST("title"),				
				"Slug" => slug(POST("title", "clean")),
				"Content" => setCode(decode(POST("content", "clean")), false),				
				"Pwd" => (POST("pwd")) ? POST("pwd", "encrypt") : null,				
				"Tags" => POST("tags"),
				"Language" => POST("language"),
				"Buffer" => (int) POST("buffer"),
				"Code" => POST("code"),
				"Situation" => POST("situation")
			);			
			
			$this->Db->update($this->table, $data, $postID);			

			echo getAlert(__("Last update on") ." ". now(6), "success");
		} else {
			$data = array(
				"ID_User" => SESSION("ZanUserID"),
				"Title"	=> POST("title"),				
				"Slug" => slug(POST("title", "clean")),
				"Content" => setCode(decode(POST("content", "clean")), false),
				"Author" => SESSION("ZanUser"),
				"Year" => date("Y"),
				"Month"	=> date("m"),
				"Day" => date("d"),
				"Language" => POST("language"),
				"Pwd" => (POST("pwd")) ? POST("pwd", "encrypt") : null,
				"Start_Date" => now(4),
				"Text_Date" => decode(now(2)),
				"Tags" => POST("tags"),
				"Buffer" => (int) POST("buffer"),
				"Code" => POST("code"),
				"Situation" => POST("situation")
			);			
			
			$insertID = $this->Db->insert($this->table, $data);

			echo getAlert(__("Saved draft on") ." ". now(6), "success");
		}

	}
	
	private function edit() 
	{	
		$this->Cache = $this->core("Cache");
		$this->Cache->removeAll("blog");
		$this->Db->update($this->table, $this->data, POST("ID"));
	
		return getAlert(__("The post has been edited correctly"), "success");
	}

	public function add($action = "save") 
	{
		$error = $this->editOrSave($action);

		if ($error) {
			return $error;
		}
		
		$this->data["Situation"] = (SESSION("ZanUserPrivilegeID") == 1 OR SESSION("ZanUserRecommendation") > 100) ? "Active" : "Pending";
		$this->data["Enable_Comments"] = true;
		$this->data["Display_Bio"] = true;

		if ($action === "save") {
			$return = $this->Db->insert($this->table, $this->data);

			$this->Users_Model = $this->model("Users_Model");
			$this->Users_Model->setCredits(1, 3);
		} elseif ($action === "edit") {
			$return = $this->Db->update($this->table, $this->data, POST("ID"));
		}

		if ($this->data["Situation"] === "Active") {
			$this->Cache = $this->core("Cache");
			$this->Cache->removeAll("blog");
		}

		if ($return) {
			return getAlert(__("The post has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}

	public function preview() 
	{
		if (POST("title") AND POST("content")) {
			$this->helper("time");

			return array(
				"ID" => POST("ID"),
				"Author" => SESSION("ZanUser"),
				"Content" => setCode(stripslashes(encode(POST("content", "decode", null))), false),
				"Day" => date("d"),
				"Enable_Comments" => true,
				"Language" => POST("language"),
				"Month"	 => date("m"),
				"Start_Date" => now(4),
				"Slug" => slug(POST("title", "clean")),
				"Tags" => stripslashes(encode(POST("tags", "decode", null))),
				"Title" => stripslashes(encode(POST("title", "decode", null))),
				"Year" => date("Y")
			);
		} else {
			return false;
		}
	}

	public function getAllByUser() 
	{
		return $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, $this->fields, null, "ID_Post DESC");
	}

	public function getBufferPosts($language = "all") 
	{		
		$fields = "ID_Post, Title, Slug, Year, Month, Day, Language";

		if ($language === "all") {
			return $this->Db->findBySQL("Buffer = 1 AND Situation = 'Active'", $this->table, $fields, null, "rand()", 85);
		} else {
			return $this->Db->findBySQL("Buffer = 1 AND Language = '$language' AND Situation = 'Active'", $this->table, $fields, null, "rand()", 85);
		}
	}

	public function getBufferSabio() 
	{		
		return $this->Db->findBySQL("Buffer = 1", "phrases", "Phrase", null, "rand()", 150);		
	}
	
	private function search($search, $field) 
	{
		if ($search and $field) {
			return ($field === "ID") ? $this->Db->find($search, $this->table) : $this->Db->findBySQL("$field LIKE '%$search%'", $this->table, $this->fields);	      
		} else {
			return false;
		}
	}
	
	public function count($type = "posts") 
	{					
		$year = isYear(segment(1,  isLang())) ? segment(1, isLang()) : false;
		$month = isMonth(segment(2, isLang())) ? segment(2, isLang()) : false;
		$day = isDay(segment(3,   isLang())) ? segment(3, isLang()) : false;

		if ($type === "posts") {									
			if ($year and $month and $day) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Situation = 'Active'", $this->table);
			} elseif ($year and $month) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Month = '$month' AND Situation = 'Active'", $this->table);
			} elseif ($year) {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Year = '$year' AND Situation = 'Active'", $this->table);
			} else {
				$count = $this->Db->countBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table);
			}
		} elseif ($type === "comments") {
			$count = 0;
		} elseif ($type === "tag") {
			$data = $this->getByTag(segment(2, isLang()));
			
			$count = count($data);
		} elseif ($type === "author") {
			$author = segment(2, isLang());
			$count = $this->Db->countBySQL("Author = '$author' AND Language = '$this->language' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		} elseif ($type === "author-tag") {
			$author = segment(2, isLang());
			$tag = segment(4, isLang());
			$count = $this->Db->countBySQL("Author = '$author' AND (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table);
		}
		
		return isset($count) ? $count : 0;
	}
	
	public function getArchive() 
	{				
		$data = $this->Db->findFirst($this->table, "Year, Month");
		
		if ($data) {
			$date["year"] = $data[0]["Year"];
			$date["month"] = $data[0]["Month"];
			
			return $date;
		} else {
			return false;
		}
	}

	public function getMostRelevantPosts($limit = 10) 
	{
		return $this->Db->findBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields, null, "RAND()", $limit);
	}
	
	public function getMural($limit) {		
		return $this->Db->findAll("mural", "Title, URL, Image", null, "ID_Post DESC", $limit);				
	}
	
	public function getMuralByID($ID_Post) {				
		return $this->Db->findBy("ID_Post", $ID_Post, "mural", "Title, URL, Image");			
	}
	
	public function getPosts($limit) {	
		return $this->Db->findBySQL("Language = '$this->language' AND Situation = 'Active'", $this->table, $this->fields, null, "ID_Post DESC", $limit);
	}
	
	public function getPost($year, $month, $day, $slug) 
	{		
		$query = "Slug = '$slug' AND Year = '$year' AND Month = '$month' AND Day = '$day' AND Language = '$this->language' AND Situation = 'Active'";
		$data = $this->Db->findBySQL($query, $this->table, $this->fields);
		
		if ($data) {
			$this->Cache = $this->core("Cache");

			$views = $this->Cache->getValue($data[0]["ID_Post"], "blog", "Views", true);

			$this->Cache->setValue($data[0]["ID_Post"], $views + 1, "blog", "Views", 86400);

			$post[0]["post"] = $data;
									
			return $post;
		}		
		
		return false;
	}
	
	public function getByDate($limit, $year = false, $month = false, $day = false) 
	{		
		$query = "Language = '$this->language' AND Year = '$year' AND Situation = 'Active'";

		if ($year and $month and $day) {
			return $this->Db->findBySQL($query ." AND Month = '$month' AND Day = '$day'", $this->table, $this->fields, null, "ID_Post DESC", $limit);
		} elseif ($year and $month) {
			return $this->Db->findBySQL($query ." AND Month = '$month'", $this->table, $this->fields, null, "ID_Post DESC", $limit);
		} elseif ($year) {
			return $this->Db->findBySQL($query, $this->table, $this->fields, null, "ID_Post DESC", $limit);
		}	
	}

	public function getAllByAuthor($author, $limit) 
	{
		return $this->Db->findBySQL("Author = '$author' AND Language = '$this->language' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table, $this->fields, null, "ID_Post DESC", $limit);
	}

	public function getAllByTag($author, $tag, $limit) 
	{
		$query = "Author = '$author' AND (Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') 
				  AND Language = '$this->language' AND (Situation = 'Active' OR Situation = 'Pending')";

		return $this->Db->findBySQL($query, $this->table, $this->fields, null, "ID_Post DESC", $limit);
	}
	
	public function getByID($ID) 
	{			
		return $this->Db->find($ID, $this->table, $this->fields);
	}
	
	public function getByTag($tag, $limit = false) 
	{
		$tag = str_replace("-", " ", $tag);
		$query = "(Title LIKE '%$tag%' OR Content LIKE '%$tag%' OR Tags LIKE '%$tag%') AND Language = '$this->language' AND Situation = 'Active'";
		
		return $this->Db->findBySQL($query, $this->table, $this->fields, null, "ID_Post DESC", $limit);
	}
	
	public function deleteMural() 
	{
		$this->ID_Post = POST("ID_Post");
		$this->mural = POST("muralExist");
	
		unlink($this->mural);
					
		$this->Db->deleteBy("ID_Post", $this->ID_Post, "mural");
	}
	
	public function removePassword($ID) 
	{
		$this->Db->update($this->table, array("Pwd" => ""), $ID);		
	}

	public function getPostByID($ID) 
	{
		return $this->Db->findBySQL("Situation != 'Deleted' AND ID_User = ". SESSION("ZanUserID") ." AND ID_Post = ". $ID, $this->table, $this->fields);
	}
	
	public function find($query, $order, $limit, $own = false) 
	{
		$fields = "ID_Post, Title, Author, Views, Start_Date, Year, Month, Day, Slug, Language, Situation";

		if (SESSION("ZanUserPrivilegeID") === 1 and !$own) {
			return $this->Db->findBySQL("Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, $fields, null, $order, $limit);
		} else {
			$query = "ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted' AND Title LIKE '%$query%'";

			return $this->Db->findBySQL($query, $this->table, $fields, null, $order, $limit);
		}		
	}

	public function found($query, $order, $own = false) 
	{
		if (SESSION("ZanUserPrivilegeID") === 1 and !$own) {
			return  $this->Db->findBySQL("Situation != 'Deleted' AND Title LIKE '%$query%'", $this->table, "COUNT(1) AS Total", null, $order);
		} else {
			$query = "ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted' AND Title LIKE '%$query%'";

			return $this->Db->findBySQL($query, $this->table, "COUNT(1) AS Total", null, $order);
		}
	}

	public function records($action, $start = 0, $end = MAX_LIMIT, $order = null, $search = false) 
	{
		if (is_null($order)) {
			$order = "ID_Post DESC";
		}

		if ($action === "all") {
			return $this->all(false, $order, "$start, $end", true);
		} elseif ($action === "records") {
			$data = $this->all(false, $order, "$start, $end", true);

			return $this->processRecords($data);
		} else {
			$data = $this->find($action, $order, "$start, $end", true);
			$data = $this->processRecords($data);

			if ($start === 0) {
				$total = $this->found($action, $order, true);

				if ($data) {
					array_unshift($data, $total[0]);
				} else {
					$data = array("0");
				}
			}

			return $data;
		}
	}

	private function processRecords($data) 
	{
		if (is_array($data)) {
			$this->helper("time");

			foreach ($data as $key => $record) {
				if (isset($record["Language"])) {
					$data[$key]["Language"] = getLanguage($record["Language"], true);
				}

				if (isset($record["Start_Date"])) {
					$data[$key]["Start_Date"] = ucfirst(howLong($record["Start_Date"]));
				}

				if (isset($record["End_Date"])) {
					$data[$key]["End_Date"] = ucfirst(howLong($record["End_Date"]));
				}

				if (isset($record["Modified_Date"])) {
					$data[$key]["Modified_Date"] = ucfirst(howLong($record["Modified_Date"]));
				}

				if (isset($record["Situation"])) {
					$data[$key]["Situation"] = __($record["Situation"]);
				}

				if (isset($record["Views"])) {
					$data[$key]["Views"] = (int) $record["Views"];
				}
			}
		}

		return $data;
	}

	public function getByUser($ID_User, $limit)
	{
		return $this->Db->findBySQL("ID_User = '$ID_User' AND (Situation = 'Active' OR Situation = 'Pending')", $this->table, $this->fields, null, "ID_Post DESC", "0, $limit");
	}
}