<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Works_Controller extends ZP_Load {
	
	private $effect = FALSE;
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		//$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("works");

		//$this->Templates->theme();
		
		//$this->Works_Model = $this->model("Works_Model");

		//$this->helper("pagination");

		setURL();
	}
	
	public function index($workID = 0) {
		/*
		$this->meta("language", whichLanguage(FALSE));
                
		if($workID !== "add") {
			if($workID > 0) {
				$this->go($workID);
			} else {
				$this->getWorks();
			}
		}
		*/
		redirect();
	}

	public function works() {
		$data = $this->Works_Model->getWorks();
	
		if($data) {
			$vars["data"] = $data;
			
			$this->view("works", $vars, $this->application);				
		} 

		return FALSE;
	}
	/*
	public function add() {
		isConnected();
		
		if(POST("save")) {
			$vars["alert"] = $this->Works_Model->save();
		}

		if(POST("preview")) {
			$this->helper("time");

			$this->title(__("Works") ." - ". htmlentities(encode(POST("title", "decode", NULL)), ENT_QUOTES, "UTF-8"));

			$data = $this->Works_Model->preview();

			if($data) {
				$this->CSS("works", $this->application);
				$this->js("preview", $this->application);
				
				$this->config("user", "works");

				$vars["works"] = $data;
				$vars["view"] = $this->view("preview", TRUE);
				
				$this->render("content", $vars);
			} else {
				redirect();
			}
		} else {
			$this->CSS("forms", "cpanel");

			$this->helper(array("html", "forms"));

			$this->config("user", "works");

			$vars["view"] = $this->view("new", TRUE);

			$this->render("content", $vars);
		}
	}

	public function admin() {
		isConnected();

		$this->config("user", "works");

		$data = $this->Works_Model->getAllByUser();

		$this->CSS("results", "cpanel");
		$this->CSS("admin", "works");

		if($data) {
			$vars["tFoot"] = $data;
			$total = count($data);
		} else {
			$vars["tFoot"] = array();
			$total = 0;
		}

		$label = ($total === 1 ? __("record") : __("records"));

		$vars["total"] = (int)$total . " $label";
		
		$vars["view"] = $this->view("admin", TRUE);
		$this->render("content", $vars);
	}
	
	public function go($workID = 0) {
		$this->CSS("works", $this->application);
		$this->CSS("pagination");

		$data = $this->Cache->data("work-$workID", "works", $this->Works_Model, "getByID", array($workID));

		if($data) {
			$this->helper("time");

			$this->title(__("Works") ." - ". decode($data[0]["Title"]), FALSE);
			//$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
                        
			$vars["views"]    = $this->Works_Model->updateViews($workID);
			$vars["work"] = $data[0];
			$vars["view"]     = $this->view("work", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function visit($workID = 0) {
		$data = $this->Cache->data("work-$workID", "works", $this->Works_Model, "getByID", array($workID));

		if($data) {
			$this->Works_Model->updateViews($workID);

			redirect($data[0]["URL"]);
		} else {
			redirect();
		}
	}

	private function getWorks() { 
		$this->title(__("Works"));
		$this->CSS("works", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit();
		
		$data = $this->Cache->data("works-$limit", "works", $this->Works_Model, "getAll", array($limit));
	
		$this->helper("time");
		
		if($data) {	
			//$this->meta("keywords", $data[0]["Technologies"]);
			$this->meta("description", $data[0]["Requirements"]);
                        
			$vars["works"]  = $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("works", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}

	private function limit($type = NULL) {
		$count = $this->Works_Model->count($type);	
		
		if(is_null($type)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("works/page/");
		} elseif($type === "tag") {
			$tag   = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("works/tag/$tag/page/");
		} elseif($type === "author") {
			$user  = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("works/author/$user/page/");
		} elseif($type === "author-tag") {
			$user  = segment(2, isLang());
			$tag   = segment(4, isLang());
			$start = (segment(5, isLang()) === "page" and segment(6, isLang()) > 0) ? (segment(6, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("works/author/$user/tag/$tag/page/");
		}

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}

	/*
	public function showGallery() {		
		
		$this->paginate = NULL;
		
		if(segment(2) === _page and segment(3) > 0) $this->page = segment(3);
		else $this->page = 0;
										
		$this->end = 15;	

		if($this->page == 0) $this->start = 0; else $this->start = ($this->page * $this->end) - $this->end;
		$this->limit = $this->start.", ".$this->end;
		$this->URL   = _webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery . _sh . _page . _sh;					
		$this->count = $this->Gallery_Model->getCount();
		
						
		if($this->count > $this->end) {
			 $this->paginate = $this->Pagination->paginate($this->count, _maxLimitGallery, $this->start, $this->URL);
		}		
		
		$data = $this->Gallery_Model->getByAlbum(FALSE, $this->limit);
	
		if($data === FALSE) {				
			redirect(_webBase);	
		//Agregar comparación para ver si hay efectos activos, de mientras la quitaré.		
		} else {										
			
			if(isset($this->paginate)) $vars["pagination"] = $this->paginate;
			
			$vars["count"] = $this->count;
			$vars["pictures"] = $data;
			$vars["view"]   = $this->view("gallery", $this->application, TRUE);
			$this->template("content", $vars);
			
			$this->Render();
		}				
	}
	
	public function showImage() {		
					
		$data = $this->Gallery_Model->getByID(segment(3), TRUE);
	
		if(!$data) {
			redirect(_webBase . _sh . getXMLang(whichLanguage()) . _sh . _gallery);
		}
		
		if($data["Album"] !== "None") {
			$this->count = $this->Gallery_Model->getCount($data["Album_Nice"]);
		} else {
			$this->count = $this->Gallery_Model->getCount();
		}
					
		//Código para comentarios:
		/*
		if(isset($_POST["publishComment"])) {
			$this->Set("Comment");
		}
		 
		if($this->Users_Model->isMember()) {
			$vars["publish"] = TRUE;
		}
		
		if(isset($error) and is_array($error)) {
			$vars["error"] = $error;
		}
		
		$comments = $this->Gallery_Model->getComments($this->record["ID"]);
		if($comments == FALSE) $vars["comments"] = FALSE;
		else $vars["comments"] = $comments;
			
		$vars["count"]   = $this->count;
		$vars["picture"] = $data;
					
		if(_webGalleryComments === TRUE) {
			$vars["view"][0]  = $this->view("image", $this->application, TRUE);
			$vars["view"][1] = $this->view("comments", $this->application, TRUE);
		} else {
			$vars["view"]   = $this->view("image", $this->application, TRUE);			
		}

		$this->template("content", $vars);
		$this->Render();
		
	}
	*/
}
