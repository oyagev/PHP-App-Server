<?php
namespace PHAS\Lib;

class Request {
	
	public $post, $get , $cookie, $files, $server;
	
	
	static function fromJSON($json){
		if (is_string($json)){
			$json = json_decode($json);
		}
		return new static((array)$json);
	}
	
	function __construct($vars = array()){
		
		foreach(get_object_vars($this) as $name=>$val){
			if (isset($vars[$name])){
				$this->$name = $vars[$name];
			}
		}
	}
	
	
	function toJSON(){
		return json_encode($this);
	}

	public function getPost()
	{
	    return $this->post;
	}

	public function setPost($post)
	{
	    $this->post = $post;
	}

	public function getGet()
	{
	    return $this->get;
	}

	public function setGet($get)
	{
	    $this->get = $get;
	}

	public function getCookie()
	{
	    return $this->cookie;
	}

	public function setCookie($cookie)
	{
	    $this->cookie = $cookie;
	}

	public function getFiles()
	{
	    return $this->files;
	}

	public function setFiles($files)
	{
	    $this->files = $files;
	}

	public function getServer()
	{
	    return $this->server;
	}

	public function setServer($server)
	{
	    $this->server = $server;
	}
}