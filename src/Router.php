<?php

class Router {
	public $path_info;
	public $routes;

	private $data;

	public function __construct(&$data) {
		$this->data = $data;
	}

	public function __destruct() {
		if (empty($this->routes[$this->path_info])) { 
			echo '404'; return; 
		}

		call_user_func_array($this->routes[$this->path_info],array(&$this->data));
	}
}