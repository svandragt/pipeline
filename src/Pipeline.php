<?php

/**
 * Class Pipeline
 *
 * A pipeline is a queue of callbacks that get called in order on destruction.
 */
class Pipeline {
	public $callbacks = [];
	protected $data = [];

	public function __construct( $data = [] ) {
		if ( false === empty( $data ) ) {
			$this->data = $data;
		}
	}

	public function __destruct() {
		// Make all callbacks passing in a shared $data array
		foreach ( array_values( $this->callbacks ) as $callback ) {
			call_user_func_array( $callback, [ &$this->data ] );
		}
	}

	/**
	 * Add a callback to the end of the queue
	 *
	 * @param $callback
	 *
	 * @return $this
	 */
	public function add( $callback ) {
		if ( false === is_array( $callback ) ) {
			$this->callbacks[] = $callback;
		} else {
			foreach ( $callback as $id => $function ) {
				$this->callbacks[ $id ] = $function;
			}
		}

		return $this;
	}

	/**
	 * Add callback before another in the queue
	 *
	 * @param string|array $callback New callback, can have a key.
	 * @param string $existing_callback Existing callback value
	 *
	 * @return Pipeline $this
	 */
	public function add_before( $callback, $existing_callback ) {
		if ( false === is_array( $callback ) ) {
			$callback = [ $callback ];
		}

		$index = array_search( $existing_callback, array_values( $this->callbacks ) );

		if ( false !== $index ) {
			$this->add_at( $callback, $index );
		}

		return $this;
	}

	/**
	 * Insert a new callback at index
	 *
	 * @param string $callback New callback
	 * @param int $index Insertion index
	 *
	 * @return Pipeline $this
	 */
	protected function add_at( $callback, $index ) {
		array_splice( $this->callbacks, $index, 0, $callback );

		return $this;
	}
}