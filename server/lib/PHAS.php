<?php
namespace PHAS\Lib;

class PHAS{
	static function _exit(){
		
	}
	static function _die(){
		
	}
	static function header($string){
		VirtualProcess::current()->getResponse()->addHeader($string);
	}
}
