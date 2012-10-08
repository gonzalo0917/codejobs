<?php

function tagHTML($tag = NULL, $attributes = TRUE, $content = NULL) {
    if (is_null($tag)) return FALSE;
    
    if ($attributes === TRUE) {
        return "<$tag>";
    } elseif ($attributes === FALSE) {
        return "</$tag>";
    } elseif (is_array($attributes)) {
        $html = "<$tag ";
        
        foreach ($attributes as $attribute => $value) {
            $html .= " $attribute = \"$value\"";
        }
        
        $html .= ">";
        
        if (! is_null($content)) {
            $html .= "\n$content\n</$tag>";
        }
        
        return $html;
    } else {
        return "<$tag>$attributes</$tag>";
    }
}