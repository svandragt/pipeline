<?php

/**
 * Class Router
 * A router is a Pipeline that makes a single callback on destruction.
 */
class Router extends Pipeline {
	public $path_info;

	public function __construct( &$data ) {
		$this->path_info = $_SERVER['PATH_INFO'];
		parent::__construct( $data );
	}

	public function __destruct() {
		// make a single callback
		if ( empty( $this->callbacks[ $_SERVER['PATH_INFO'] ] ) ) {
			header( "HTTP/1.0 404 Not Found" );
			echo '404 Page not found';

			return;
		}
		$cb = $this->callbacks[ $_SERVER['PATH_INFO'] ];
		call_user_func_array( $cb, [ &$this->data ] );

		$this->reset_queue();
		parent::__destruct();
	}

	private function reset_queue() {
		$this->callbacks = [];
	}
}