<?php

namespace PHAS\Lib;

class ServerConfig {
	public $opts=array();
	
	
	function __construct($opts){
		$this->opts = array_merge($this->opts,$opts);
	}
	
	function get($key){
		if (isset($this->opts[$key])){
			return $this->opts[$key];
		}
		throw new Exception('Config not found: '.$key);
	}
	function set($key,$value){
		$this->opts[$key] = $value;
		return $this;
	}
	
	
}