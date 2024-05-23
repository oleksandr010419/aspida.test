<?php 
class FilterTools {

    static function removeXSS($val) {
        return htmlspecialchars($val, ENT_QUOTES);
    }
	
    static function filterIntValue($value) {
        $number = filter_var(preg_replace("/[^0-9]/", "", $value), FILTER_SANITIZE_NUMBER_INT);
        return $number;
    }

    static function filterFloatValue($value) {
        $returnValue = null;
        if (!$value)
            $returnValue = null;
        if (is_numeric($value)) {
            $returnValue = floatval($value);
        } else {
            $returnValue = null;
        }
        return $returnValue;
    }

    static function filterStringValue($value) {
        $returnValue = null;
        if (!$value)
            $returnValue = null;
        $value = substr($value, 0, 40);
        $returnValue = htmlspecialchars($value);
        return $returnValue;
    }

    static function filterTextValue($value) {
        $returnValue = null;
        if (!$value)
            $returnValue = null;
        $returnValue = htmlspecialchars($value);
        return $returnValue;
    }
	
	static function cleanupPost($post){
		if(isset($post['awood']))$post['awood'] = round(intval($post['awood']));
		if(isset($post['aclay']))$post['aclay'] = round(intval($post['aclay']));
		if(isset($post['airon']))$post['airon'] = round(intval($post['airon']));
		if(isset($post['acrop']))$post['acrop'] = round(intval($post['acrop']));
		return$post;
	}
}