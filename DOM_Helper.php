<?php
    
    function myCreateEntry($doc, $parent, $name, $text, $attributeArray = array()) {
        
        $element = myCreateChild($doc, $parent, $name);
        
        myCreateChildText($doc, $element, $text);
        
        foreach($attributeArray as $attribute => $value) {
            
            $element->setAttribute($attribute, $value);
        }
        
        return $element;
    }

    function myCreateChild($doc, $parent, $name) {
        
        $child = $doc->createElement($name);
        
        $childNode = $parent->appendChild($child);
        
        return $child;
    }

    function myCreateChildText($doc, $parent, $text) {
        
        $child = $doc->createTextNode($text);
        
        $childNode = $parent->appendChild($child);
        
        return $childNode;      
    }
?>