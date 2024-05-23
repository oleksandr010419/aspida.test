<?php
###############################  E    N    D   ##################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Developed by:  Brainiac & Wolfcruel                                        ##
##  License:       BrainianZ Project                                        ##
##  Copyright:     BrainianZ © 2011-2014. Skype brainiac.brainiac         ##
##                                                                             ##
#################################################################################

class Form {

	private $errorarray = array();
	public $valuearray = array();
	private $errorcount;

	public function Form() {
		if(isset($_SESSION['errorarray'])) {
			$this->errorarray = $_SESSION['errorarray'];
			$this->errorcount = count($this->errorarray);

			unset($_SESSION['errorarray']);
			unset($_SESSION['valuearray']);
		}
		else {
			$this->errorcount = 0;
		}
		if(isset($_SESSION['valuearray'])){
			$this->valuearray = $_SESSION['valuearray'];
			unset($_SESSION['valuearray']);
		}
	}

	public function addError($field,$error) {
		$this->errorarray[$field] = $error;
		$this->errorcount = count($this->errorarray);
	}

	public function getError($field) {
		if(array_key_exists($field,$this->errorarray)) {
			return $this->errorarray[$field];
		}
		else {
			return "";
		}
	}

	public function getValue($field) {
		if(array_key_exists($field,$this->valuearray)) {
			return $this->valuearray[$field];
		}
		else {
			return "";
		}
	}

	public function getDiff($field,$cookie) {
		if(array_key_exists($field,$this->valuearray) && $this->valuearray[$field] != $cookie) {
			return $this->valuearray[$field];
		}
		else {
			return $cookie;
		}
	}

	public function getRadio($field,$value) {
		if(array_key_exists($field,$this->valuearray) && $this->valuearray[$field] == $value) {
			return "checked";
		}
		else {
			return "";
		}
	}

	public function returnErrors() {
		return $this->errorcount;
	}

	public function getErrors() {
		return $this->errorarray;
	}
};
