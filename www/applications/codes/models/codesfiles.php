<?php
/**
 * Access from index.php:
 */
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here...");
}

class CodesFiles_Model extends ZP_Load {
	public function __construct() {
		$this->Db = $this->db();
		$this->table  = "codes_files";
	}
        
    public function getByCode($code, $limit = null) {
        return $this->Db->findBy("ID_Code", $code, $this->table, null, null, "ID_File ASC", $limit);
    }        
    
    public function getCodeOnly($code) {
        $data = $this->Db->findBy("ID_Code", $code, $this->table, "Code", null, "ID_File ASC", 1);
        
        return ($data) ? $data[0]["Code"] : false;        
    }  
}