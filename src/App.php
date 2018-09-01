<?php

class App {
	public $pipes = [];

	private $data;

	public function __construct( $data = [] ) {
		$this->data = $data;
	}

	public function __destruct() {
		foreach ( $this->pipes as $pipe ) {
			call_user_func_array( $pipe, array( &$this->data ) );
		}
	}

	/**
	 * Connect two pipes
	 *
	 * @param string $from Named source pipe
	 * @param string $to Named destination pipe
	 *
	 * @return App $this
	 */
	public function connect( $from, $to = '' ) {

		if ( empty( $to ) ) {
			$this->pipes[] = $from;

			return $this;
		}

		list( $new_pipe, $index ) = $this->get_insert_index( $from, $to );

		if ( false === $index ) {
			return $this;
		}

		$this->insert_pipe_at( $new_pipe, $index );

		return $this;
	}

	/**
	 * Determine what the new pipe is where where it is inserted.
	 *
	 * @param string $from Named source pipe
	 * @param string $to Named destination pipe
	 *
	 * @return array List of the name of the new pipe, and its insertion point
	 */
	private function get_insert_index( $from, $to ) {
		$new_pipe = $to;
		$index    = array_search( $from, array_values( $this->pipes ) );
		if ( false === $index ) {
			$new_pipe = $from;
			$index    = array_search( $to, array_values( $this->pipes ) );
		}

		return array( $new_pipe, $index );
	}

	/**
	 * Insert a new pipe at index
	 *
	 * @param string $new_pipe Name of new pipe
	 * @param int $index Insertion point
	 */
	private function insert_pipe_at( $new_pipe, $index ) {
		$pre         = array_slice( $this->pipes, 0, $index, true );
		$post        = array_slice( $this->pipes, $index, count( $this->pipes ) - $index, true );
		$this->pipes = array_merge( $pre, [ $new_pipe ], $post );
	}
}