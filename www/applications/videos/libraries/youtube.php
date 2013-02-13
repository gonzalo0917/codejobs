<?php

class YouTube
{
	public $typeRequest;
	public $client;
	public $method;
	public $format;

	public function __construct()
	{
		$this->typeRequest = "GET";
		$this->client = "http://gdata.youtube.com/feeds/api/";
		$this->method = null;
		$this->format = "array";
	}

	public function query($query = null)
	{
		$this->uri = $query;

		return $this->data();
	}
	
	public function search($search = "", $max = 9, $start = 1)
	{
		$search = str_replace(" ", "+", trim($search));

		$this->uri = $this->client ."videos/?vq=". $search ."&start-index=". $start ."&max-results=". $max ."&alt=". strtolower($this->format);

		return $this->data();
	}
	
	public function getByUser($username = null, $max = 9, $start = 1)
	{
		$this->uri = $this->client ."users/". trim($username) ."/uploads/?start-index=". $start ."&max-results=". $max ."&alt=". strtolower($this->format);
		
		return $this->data();
	}
	
	public function getByID($ID = null)
	{
		$this->uri = $this->client ."videos/". trim($ID) ."?alt=". strtolower($this->format);
		
		return $this->data();
	}
	
	public function data()
	{
		 try {
            $this->results = $this->getResult();

            if (!$this->results or is_null($this->results)) {
                return false;
            } else {
                return $this->results;
            }
        } catch (Exception $e) {
            return false;
        }
	}
	
	private function getResult()
	{
		switch (strtolower($this->format)) {
			case "json":
				$results = json_decode(@file_get_contents(str_replace(array("&alt=array", "?alt=array"), array("&alt=json", "?alt=json"), $this->uri), false, stream_context_create(array('http' => array('timeout' => 5, 'method' => $this->typeRequest)))));

				if ($results) {
					if ($results->{'openSearch$totalResults'}->{'$t'} > 0) {
						return $results;
					} else {
						return false;
					}
				} else {
					return false;
				}

			break;
				
			case "xml":
				return @simplexml_load_file(str_replace("&alt=xml", "", $this->uri));
			break;

			case "array":
				$results = json_decode(@file_get_contents(str_replace(array("&alt=array", "?alt=array"), array("&alt=json", "?alt=json"), $this->uri), false, stream_context_create(array('http' => array('timeout' => 5, 'method' => $this->typeRequest)))));

				if ($results) {
					if (isset($results->entry) and !isset($results->feed)) {
						$entry = $results->entry;
						
						$data = array(
							"id" => $this->id($entry->id->{'$t'}),
							"title" => $entry->title->{'$t'},
							"cut" => $this->cut($entry->title->{'$t'}),
							"content" => $entry->content->{'$t'},
							"views" => $entry->{'yt$statistics'}->viewCount
						);
						
						return $data;
					} else {
						if ($results->feed->{'openSearch$totalResults'}->{'$t'} > 0) {
							foreach ($results->feed->entry as $entry) {
								$data["videos"][] = array(
									"id" => $this->id($entry->id->{'$t'}),
									"title" => $entry->title->{'$t'},
									"cut" => $this->cut($entry->title->{'$t'}),
									"content" => $entry->content->{'$t'},
								);
							}

							$data["self"] = $this->self($results->feed->link);
							$data["next"] = $this->next($results->feed->link);
							$data["prev"] = $this->prev($results->feed->link);

							return $data;
						} else {
							return false;
						}
					}
				} else {
					return false;
				}
			break;

			default:
				return json_decode(@file_get_contents($this->uri, false, stream_context_create(array('http'=>array('timeout' => 5, 'method' => $this->typeRequest)))));
			break;
		}
	}

	private function id($entry)
	{
		$_array = explode("/", $entry);

		return $_array[count($_array) - 1];
	}

	private function cut($title, $start = 0, $end = 13, $text = "...")
	{
		return substr($title, $start, $end) . $text;
	}

	private function self($link)
	{
		if (is_array($link)) {
			foreach ($link as $value) {
				if ($value->rel == "self") {
					return $value->href;
				}
			}

			return false;
		} else {
			return false;
		}
	}

	private function next($link)
	{
		if (is_array($link)) {
			foreach ($link as $value) {
				if ($value->rel == "next") {
					return $value->href;
				}
			}
			
			return false;
		} else {
			return false;
		}
	}
	
	private function prev($link)
	{
		if (is_array($link)) {
			foreach ($link as $value) {
				if ($value->rel == "prev") {
					return $value->href;
				}
			}
			
			return false;
		} else {
			return false;
		}
	}

	public function validVideo($videoID)
	{
		$headers = @get_headers($this->client."videos/".$videoID);

		if (!strpos($headers[0], '200')) {
			#echo "The YouTube video you entered does not exist";
			return false;
		}

		return true;
	}
}
