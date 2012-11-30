<?php
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

function linesWrap($text, $maxLines = 3) {
    return implode("\r\n", array_slice(explode("\r\n", $text), 0, $maxLines));
}

function removeBreaklines($text, $replace = " ") {
    return preg_replace("/\r\n+/", $replace, $text);
}

function getSyntax() {
    global $Load;

    $Db = $Load->core("Db");
    
    return $Db->findAll("codes_syntax", "ID_Syntax, Name, MIME, Filename, Extension", NULL, "Name ASC");
}

function getSyntaxJSON() {
    $data = getSyntax();
    
    if ($data) {
        return json($data);
    }
    
    return array();
}

function recoverFiles() {
    list($idfiles, $syntax, $names, $codes) = array(recoverPOST("file"), recoverPOST("syntax"), recoverPOST("name"), recoverPOST("code"));
    
    if (is_array($idfiles) and is_array($syntax) and is_array($names) and is_array($codes)) {
        $return = array();
        
        for($i = 0; $i < count($idfiles); $i++) {
            $return[] = array(
                "ID_File"       => $idfiles[$i],
                "Name"          => $names[$i],
                "ID_Syntax"     => $syntax[$i],
                "Code"          => $codes[$i]
            );
        }
        
        return $return;
    }
    
    return array(array(
        "ID_File"       => "",
        "Name"          => "",
        "ID_Syntax"     => 1,
        "Code"          => ""
    ));
}