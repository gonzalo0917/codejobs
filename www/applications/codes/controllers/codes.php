<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Codes_Controller extends ZP_Load {
	
	public function __construct() {		
		$this->Templates = $this->core("Templates");
		$this->Cache     = $this->core("Cache");
		
		$this->application = $this->app("codes");
		
		$this->Templates->theme();

		$this->config("codes");
		
		$this->Codes_Model 		= $this->model("Codes_Model");
        $this->CodesFiles_Model = $this->model("CodesFiles_Model");

		$this->helper("pagination");
	}
	
	public function index($codeID = 0) {
		$this->meta("language", whichLanguage(FALSE));

		if($codeID > 0) {
			$this->go($codeID);
		} else {
			$this->getCodes();
		}
	}

	public function like($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setLike($ID, "codes", 17);
	}

	public function dislike($ID) {
		$this->Users_Model = $this->model("Users_Model");

		$this->Users_Model->setDislike($ID, "codes", 17);
	}

	public function report($ID) {
		$this->Codes_Model->setReport($ID);
	}	

	public function language($language) {
		$this->title(__("Codes", FALSE));
		
        $this->CSS("codes", $this->application);
		$this->CSS("pagination");
		
        $limit = $this->limit("language");

		$data = $this->Cache->data("language-$language-$limit", "codes", $this->Codes_Model, "getByLanguage", array($language, $limit));

		if($data) {
			$this->helper(array("time", "html"));
            $this->helper("codes", $this->application);
                        
            foreach($data as $pos => $code) {
                $file = $this->CodesFiles_Model->getByCode($code["ID_Code"], 1);
                
                if($file) {
                    $data[$pos]["File"] = $file[0];
                } else {
                    redirect();
                   
                    exit;
                }
            }

            $this->meta("keywords", $data[0]["Languages"]);

            if($data[0]["Description"] !== "") {
				$this->meta("description", $data[0]["Description"]);
            }

            $this->js("codes", "codes");
            $this->CSS("codes_", "codes");

			$vars["codes"]  	= $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();
		}
	}

	public function go($codeID = 0) {
        $this->CSS("codes", $this->application);
		$this->CSS("pagination");

		$data = $this->Cache->data("code-$codeID", "codes", $this->Codes_Model, "getByID", array($codeID));

		if($data) {
			$this->helper(array("time", "html"));
            $this->helper("codes", $this->application);
                        
            $files = $this->CodesFiles_Model->getByCode($data[0]["ID_Code"]);
            
            if($files) {
                $data[0]["Files"] = $files;
            	$this->title(__("Codes", FALSE) ." - ". stripslashes(decode($data[0]["Title"])));
			
                $this->Codes_Model->updateViews($codeID);

                $this->meta("keywords", $data[0]["Languages"]);

	            if($data[0]["Description"] !== "") {
					$this->meta("description", $data[0]["Description"]);
	            }

	            $this->js("codes", "codes");
	            $this->CSS("code", "codes");

                $vars["code"] 	= $data[0];
                $vars["view"]   = $this->view("code", TRUE);

                $this->render("content", $vars);
            } else {
                redirect();
            }
		} else {
			redirect();
		}
	}

	private function getCodes() {
		$this->title(__("Codes", FALSE));
                
        $this->CSS("codes", $this->application);
		$this->CSS("pagination");
                
		$limit = $this->limit();
		
		$data = $this->Cache->data("codes-$limit", "codes", $this->Codes_Model, "getAll", array($limit));

		$this->helper(array("time", "html"));
        $this->helper("codes", $this->application);
		
		if($data) {	
           	foreach($data as $pos => $code) {
               	$content = $this->CodesFiles_Model->getByCode($code["ID_Code"], 1);
                
                if($content) {
                    $data[$pos]["File"] = $content[0];
                } else {
                    redirect();
                }
            }
			
            $this->meta("keywords", $data[0]["Languages"]);

            if($data[0]["Description"] !== "") {
				$this->meta("description", $data[0]["Description"]);
            }

            $this->js("codes", "codes");
            $this->CSS("codes_", "codes");

			$vars["codes"]  	= $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect();	
		} 
	}

	private function getCodesByAuthor($author) {
		$this->title(decode(__("Codes of") ." ". $author));
		$this->CSS("codes", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("author");
		
		$data = $this->Cache->data("author-$author-$limit", "codes", $this->Codes_Model, "getAllByAuthor", array($author, $limit));
	
		$this->helper(array("time", "html"));
		$this->helper("codes", $this->application);
		
		if($data) {	
			foreach($data as $pos => $code) {
               	$content = $this->CodesFiles_Model->getByCode($code["ID_Code"], 1);
                
                if($content) {
                    $data[$pos]["File"] = $content[0];
                } else {
                    redirect($this->application);
                }
            }
			
			$this->meta("keywords", $data[0]["Languages"]);

            if($data[0]["Description"] !== "") {
				$this->meta("description", $data[0]["Description"]);
            }

            $this->js("codes", "codes");
            $this->CSS("codes_", "codes");

			$vars["codes"]  	= $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect($this->application);	
		} 
	}

	private function getCodesByLanguage($author, $language) {
		$this->title(decode(__("Codes of") ." ". $author));
		$this->CSS("codes", $this->application);
		$this->CSS("pagination");
		
		$limit = $this->limit("author-language");
		
		$data = $this->Cache->data("author-$author-language-$language-$limit", "codes", $this->Codes_Model, "getAllByLanguage", array($author, $language, $limit));
	
		$this->helper(array("time", "html"));
		$this->helper("codes", $this->application);
		
		if($data) {	
			foreach($data as $pos => $code) {
               	$content = $this->CodesFiles_Model->getByCode($code["ID_Code"], 1);
                
                if($content) {
                    $data[$pos]["File"] = $content[0];
                } else {
                    redirect($this->application);
                }
            }
			
            $this->meta("keywords", $data[0]["Languages"]);

            if($data[0]["Description"] !== "") {
				$this->meta("description", $data[0]["Description"]);
            }
			
            $this->js("codes", "codes");
            $this->CSS("codes_", "codes");
			
			$vars["codes"]  	= $data;
			$vars["pagination"] = $this->pagination;
			$vars["view"]       = $this->view("codes", TRUE);
			
			$this->render("content", $vars);
		} else {
			redirect($this->application);	
		} 
	}

	public function rss() {
		$this->helper("time");

		$data = $this->Cache->data("rss", "codes", $this->Codes_Model, "getRSS", array(), 86400);
		
		if($data) {
			$this->helper("codes", $this->application);

			foreach ($data as $pos => $code) {
				$content = $this->Cache->data("rss-code-{$code["ID_Code"]}", "codes", $this->CodesFiles_Model, "getCodeOnly", array($code["ID_Code"]), 86400);
			    if ($content) {
			        $data[$pos]["Code"] = $content;
			    } else {
			        redirect();
			        exit;
			    }
			}
			
			$vars["codes"]= $data;	

			$this->view("rss", $vars, $this->application);
		} else {
			redirect();
		}
	}
        
    public function add() {
		isConnected();

		if(POST("save")) {
			$vars["alert"] = $this->Codes_Model->add();
		} 

		$this->CSS("new", "codes");
		$this->CSS("forms", "cpanel");

		$this->helper(array("html", "forms"));
		$this->helper("codes", $this->application);

		$this->config("user", "codes");

		$this->js("mode", "codes");
		$vars["view"] = $this->view("new", TRUE);

		$this->render("content", $vars);
	}

	public function admin() {
		isConnected();

		$this->config("user", "codes");

		$data = $this->Codes_Model->getCodesByUser(SESSION("ZanUserID"));

		$this->CSS("results", "cpanel");
		$this->CSS("admin", "codes");

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

	public function author($user = NULL, $languageLabel = NULL, $language = NULL) {
		if($user === NULL) {
			redirect($this->application);
		} elseif($languageLabel === NULL or $languageLabel === "page") {
			$this->getCodesByAuthor($user);
		} elseif($languageLabel === "language" and $language !== NULL) {
			$this->getCodesByLanguage($user, $language);
		} else {
			redirect("$this->application/author/$user");
		}
	}

	public function download($ID = 0, $slug = "code") {
		isConnected();

		if($ID > 0) {
			$Zip 	  = new ZipArchive;
			$filename = tempnam(__DIR__, "");
			$data	  = $this->CodesFiles_Model->getByCode($ID);
			
			$Zip->open($filename, ZipArchive::CREATE);

			if($data) {
				for($i = 0; $i < count($data); $i++) {
					$Zip->addFromString($data[$i]['Name'], decode(stripslashes($data[$i]['Code'])));
				}
			}
			
			$Zip->close();

			header('Content-Type: application/zip');
			header("Content-disposition: attachment; filename=$slug.zip");
			header("Content-Length: ". filesize($filename));

			readfile($filename);
			unlink($filename);
		}
	}
        
	private function limit($type = NULL) {
		$count = $this->Codes_Model->count($type);	
		
		if(is_null($type)) {
			$start = (segment(1, isLang()) === "page" and segment(2, isLang()) > 0) ? (segment(2, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("codes/page/");
		} elseif($type === "language") {
			$language = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("codes/language/$language/page/");
		} elseif($type === "author") {
			$user  = segment(2, isLang());
			$start = (segment(3, isLang()) === "page" and segment(4, isLang()) > 0) ? (segment(4, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("codes/author/$user/page/");
		} elseif($type === "author-language") {
			$user  = segment(2, isLang());
			$language = segment(4, isLang());
			$start = (segment(5, isLang()) === "page" and segment(6, isLang()) > 0) ? (segment(6, isLang()) * _maxLimit) - _maxLimit : 0;
			$URL   = path("codes/author/$user/language/$language/page/");
		}

		$limit = $start .", ". _maxLimit;
		
		$this->pagination = ($count > _maxLimit) ? paginate($count, _maxLimit, $start, $URL) : NULL;

		return $limit;
	}
        
}