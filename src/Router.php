<?php

class Router {
	public $path_info;
	public $routes;

	private $data;

	public function __construct( &$data ) {
		$this->data = $data;
	}

	public function __destruct() {
		if ( empty( $this->routes[ $this->path_info ] ) ) {
			header( "HTTP/1.0 404 Not Found" );
			echo '404 Page not found';

			return;
		}

		call_user_func_array( $this->routes[ $this->path_info ], array( &$this->data ) );
	}
}