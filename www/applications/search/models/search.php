<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class Search_Model extends ZP_Load
{
	
	public function __construct()
	{
		$this->Db = $this->db();
		
		$this->language = whichLanguage();
		$this->table = "search";
		$this->fields = "ID_Search, Term, Counter, Last_Search";
	}

	public function search($term, $app)
	{
		if (strlen($term) < 2) {
			die(__("Your search is too short") . "<br />");
		}

		$content = "Description";

		if ($app === "blog") {
			$content = "Content";
			$fields = "Title, Slug, Year, Month, Day, Author, Tags, Start_Date";
			$table = "muu_blog";
			$ID = "ID_Post";
		} elseif ($app === "codes") {
			$fields = "ID_Code, Title, Slug, Author, Languages, Start_Date, Language";
			$table = "muu_codes";
			$ID = "ID_Code";
		} else {
			$fields = "ID_Bookmark, Title, Slug, Author, Tags, Start_Date, Language";
			$table = "muu_bookmarks";
			$ID = "ID_Bookmark";
		}

		$data = $this->Db->query("SELECT $fields FROM $table WHERE Title LIKE '%$term%' OR $content LIKE '%$term%' ORDER BY $ID DESC LIMIT 10");
		
		if ($data) {
			$data2 = $this->Db->query("SELECT COUNT(ID_Search) AS Total FROM muu_search WHERE Term = '$term'");
			$now = date("Y-m-d H:i:s");

			if ($data2[0]["Total"] > 0) {
				$this->Db->updateBySQL($this->table, "Counter = Counter + 1, Last_Search = '$now' WHERE Term = '$term'");
			} else {
				$data2 = array(
					"Term" => $term,
					"Last_Search" => $now
				);

				$this->Db->insert($this->table, $data2);
			}

			foreach ($data as $result) {
				$tags = ($app === "codes") ? $result["Languages"] : $result["Tags"];

				if ($app === "blog") {
					$URL = path("blog/". $result["Year"] ."/". $result["Month"] ."/". $result["Day"] ."/". $result["Slug"]);
					$tagURL = "blog/tag/";
				} elseif ($app === "codes") {
					$URL = path("codes/". $result["ID_Code"] ."/". $result["Slug"], false, $result["Language"]);
					$tagURL = "codes/language/";
				} else {
					$tagURL = "bookmarks/tag/";
					$URL = path("bookmarks/". $result["ID_Bookmark"] ."/". $result["Slug"], false, $result["Language"]);
				}

				$in = ($tags !== "") ? __("in") : null;

				echo '<div class="search-title float-left"><a href="'. $URL .'" title="'. stripslashes($result["Title"]) .'">'. stripslashes(trim($result["Title"])) .'</a></div> <div class="clear"></div>
					 '. __("Published") .' '. howLong($result["Start_Date"]) ." $in ". exploding($tags, $tagURL) ." " . __("by") . ' <a href="'. path("$app/author/". $result["Author"]) .'">'. $result["Author"] .'</a><br /><br />';
			}
		} else {
			echo __("There are not results") . "<br />";
		}
	}

	public function getTags()
	{
		$tags = array();
		$maximum = 0; 
		 
		$data = $this->Db->query("SELECT Term, Counter FROM muu_search ORDER BY Counter DESC LIMIT 20");
	
		foreach ($data as $result) {
		    $tag = $result["Term"];
		    $counter = (int) $result["Counter"];

		    $maximum = ($counter > $maximum) ? $counter : 0;
 
		    $tags[] = array(
		    	"tag" => $tag, 
		    	"counter" => $counter
		    );
		}

		shuffle($tags);

		$data = $this->Db->query("SELECT MAX(Counter) AS Total FROM muu_search");

		return array("tags" => $tags, "maximum" => $data[0]["Total"]);
	}

}
