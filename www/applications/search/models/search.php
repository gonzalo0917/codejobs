<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Search_Model extends ZP_Load {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->language = whichLanguage();
		$this->table 	= "search";
		$this->fields   = "ID_Search, Term, Counter, Last_Search";

		$this->Data = $this->core("Data");

		$this->Data->table($this->table);
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, "ID_Post DESC", $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	private function all($trash, $order, $limit, $own = FALSE) {	
		if(!$trash) { 
			return (SESSION("ZanUserPrivilegeID") == 1 and !$own) ? $this->Db->findBySQL("Situation != 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Start_Date, Year, Month, Day, Slug, Language, Situation", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Start_Date, Year, Month, Day, Slug, Language, Situation", NULL, $order, $limit);
		} else {
			return (SESSION("ZanUserPrivilegeID") == 1 and !$own) ? $this->Db->findBy("Situation", "Deleted", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit) : $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", $this->table, "ID_Post, Title, Author, Views, Language, Situation", NULL, $order, $limit);
		}
	}
	
	private function editOrSave($action) {
		if($action === "save") {
			$validations = array(
				"title"   => "required",
				"content" => "required"
			);
		} else {
			$validations = array(				
				"title"   => "required",
				"content" => "required"
			);
		}
		
		$lang = getLang(POST("language"));
		
		$this->helper(array("alerts", "time", "files"));

		$dir = "www/lib/files/images";

		$this->Files = $this->core("Files");

		$this->postImage = $this->Files->uploadImage($dir ."/blog/", "image", "resize", TRUE, TRUE, TRUE, FALSE, TRUE);
		$this->postMural = $this->Files->uploadImage($dir ."/mural/", "mural", "mural");
		
		if($action === "edit") {
			$this->post = $this->Db->find(POST("ID"), $this->table);

			$currentMural 		 = $this->post[0]["Image_Mural"];
			$currentOriginalImg  = $this->post[0]["Image_Original"];
			$currentSmallImg 	 = $this->post[0]["Image_Small"];
			$currentMediumImg 	 = $this->post[0]["Image_Medium"];
			$currentThumbnailImg = $this->post[0]["Image_Thumbnail"];
		} 

        if(is_array($this->postMural)) {
        	return getAlert(__($this->postMural["alert"]));
        }
		
		if(POST("delete_mural") === "on") {
			$this->Files->deleteFiles(array($currentMural));
			$this->postMural = FALSE;
		} else {
			if(!$this->postMural and $action == "edit") {
				$this->postMural = $currentMural;
			} elseif($this->postMural and $action == "edit") {
				$this->Files->deleteFiles(array($currentMural));
			}
		}
		
		if(POST("delete_image") === "on") {
			$this->Files->deleteFiles(array($currentOriginalImg, $currentSmallImg, $currentMediumImg, $currentThumbnailImg));
			$this->postImage = NULL;
		} else {
			if(!$this->postImage and $action == "edit") {
				$this->postImage["original"]  = $currentOriginalImg;
				$this->postImage["small"] 	  = $currentSmallImg;
				$this->postImage["medium"] 	  = $currentMediumImg;
				$this->postImage["thumbnail"] = $currentThumbnailImg;
			} elseif($this->postImage and $action == "edit") {
				$this->Files->deleteFiles(array($currentOriginalImg, $currentSmallImg, $currentMediumImg, $currentThumbnailImg));
			}
		}

		$data = array(
			"Slug"            => slug(POST("title", "clean")),
			"Content"         => setCode(decode(POST("content", "clean")), FALSE),
			"Author"          => POST("author") ? POST("author") : SESSION("ZanUser"),
			"Image_Original"  => isset($this->postImage["original"]) ? $this->postImage["original"] : NULL,
			"Image_Small"  	  => isset($this->postImage["small"])  ? $this->postImage["small"]  : NULL,
			"Image_Mural"     => isset($this->postMural) ? $this->postMural : NULL,
			"Image_Medium"    => isset($this->postImage["medium"]) ? $this->postImage["medium"] : NULL,
			"Image_Thumbnail" => isset($this->postImage["thumbnail"]) ? $this->postImage["thumbnail"] : NULL,
			"Pwd"	          => (POST("pwd")) ? POST("pwd", "encrypt") : '',			
			"Tags"		      => POST("tags"),
			"Buffer"	      => !POST("buffer") ? 0 : POST("buffer"),
			"Code"	          => !POST("code") ? code(10) : POST("code"),
		);

		if($action === "save") {
			$data["ID_User"]    = SESSION("ZanUserID");
			$data["Start_Date"] = now(4);
			$data["Text_Date"]  = decode(now(2));
			$data["Year"]	    = date("Y");
			$data["Month"]	    = date("m");
			$data["Day"]	    = date("d");
		} else {
			$data["Modified_Date"] = now(4);
		}

		$this->Data->ignore(array("delete_image", "delete_mural" , "temp_title", "temp_tags", "temp_content", "editor", "categories", "tags", "mural_exists", "mural", "pwd", "category", "language_category", "application", "mural_exist"));

		$this->data = $this->Data->proccess($data, $validations);
		
		if(isset($this->data["error"])) {
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

	
	
	private function edit() {	
		$this->Cache = $this->core("Cache");
		
		$this->Cache->removeAll("blog");
		
		$this->Db->update($this->table, $this->data, POST("ID"));
	
		return getAlert(__("The post has been edited correctly"), "success");
	}

	public function add($action = "save") {
		$error = $this->editOrSave($action);

		if($error) {
			return $error;
		}
		
		$this->data["Situation"] 		= (SESSION("ZanUserPrivilegeID") == 1 OR SESSION("ZanUserRecommendation") > 100) ? "Active" : "Pending";
		$this->data["Enable_Comments"]  = TRUE;

		if($action === "save") {
			$return = $this->Db->insert($this->table, $this->data);
			
			$this->Users_Model = $this->model("Users_Model");

			$this->Users_Model->setCredits(1, 3);
		} elseif($action === "edit") {
			$return = $this->Db->update($this->table, $this->data, POST("ID"));
		}

		if($this->data["Situation"] === "Active") {
			$this->Cache = $this->core("Cache");

			$this->Cache->removeAll("blog");
		}

		if($return) {
			return getAlert(__("The post has been saved correctly"), "success");	
		}
		
		return getAlert(__("Insert error"));
	}

	public function search($term, $app) {
		if(strlen($term) < 3) {
			die(__("Your search is too short") . "<br />");
		}

		$content = "Description";

		if($app === "blog") {
			$content = "Content";
			$fields  = "Title, Slug, Year, Month, Day, Author, Tags, Start_Date";
			$table   = "muu_blog";
			$ID      = "ID_Post";
		} elseif($app === "codes") {
			$fields = "ID_Code, Title, Slug, Author, Languages, Start_Date, Language";
			$table  = "muu_codes";
			$ID     = "ID_Code";
		} else {
			$fields = "ID_Bookmark, Title, Slug, Author, Tags, Start_Date, Language";
			$table  = "muu_bookmarks";
			$ID     = "ID_Bookmark";
		}

		$data = $this->Db->query("SELECT $fields FROM $table WHERE Title LIKE '%$term%' OR $content LIKE '%$term%' ORDER BY $ID DESC LIMIT 10");
		
		if($data) {
			$data2 = $this->Db->query("SELECT COUNT(ID_Search) AS Total FROM muu_search WHERE Term = '$term'");
			$now  = date("Y-m-d H:i:s");

			if($data2[0]["Total"] > 0) {
				$this->Db->updateBySQL($this->table, "Counter = Counter + 1, Last_Search = '$now' WHERE Term = '$term'");
			} else {
				$data2 = array(
					"Term" => $term,
					"Last_Search" => $now
				);

				$this->Db->insert($this->table, $data2);
			}

			foreach($data as $result) {
				$tags = ($app === "codes") ? $result["Languages"] : $result["Tags"];
				
				if($app === "blog") {
					$URL  = path("blog/". $result["Year"] ."/". $result["Month"] ."/". $result["Day"] ."/". $result["Slug"]);
					$tagURL = "blog/tag/";
				} elseif($app === "codes") {
					$URL = path("codes/". $result["ID_Code"] ."/". $result["Slug"], FALSE, $result["Language"]);
					$tagURL = "codes/language/";
				} else {
					$tagURL = "bookmarks/tag/";
					$URL = path("bookmarks/". $result["ID_Bookmark"] ."/". $result["Slug"], FALSE, $result["Language"]);
				}

				$in   = ($tags !== "") ? __("in") : NULL;

				echo '<div class="search-title"><a href="'. $URL .'" title="'. stripslashes($result["Title"]) .'">'. stripslashes(trim($result["Title"])) .'</a></div>
					 '. __("Published") .' '. howLong($result["Start_Date"]) ." $in ". exploding($tags, $tagURL) ." " . __("by") . ' <a href="'. path("$app/author/". $result["Author"]) .'">'. $result["Author"] .'</a><br /><br />';
			}
		} else {
			echo __("There are not results") . "<br />";
		}
	}

	public function getTags() {
		$tags = array();
		$maximum = 0; 
		 
		$data = $this->Db->query("SELECT Term, Counter FROM muu_search ORDER BY Counter DESC LIMIT 20");
	
		foreach($data as $result) {
		    $tag     = $result["Term"];
		    $counter = (int) $result["Counter"];
		 		    
		    $maximum = ($counter > $maximum) ? $counter : 0;
		 
		    $tags[] = array(
		    	"tag" 	  => $tag, 
		    	"counter" => $counter
		    );
		}
		
		shuffle($tags);

		$data = $this->Db->query("SELECT MAX(Counter) AS Total FROM muu_search");

		return array("tags" => $tags, "maximum" => $data[0]["Total"]);
	}

}
