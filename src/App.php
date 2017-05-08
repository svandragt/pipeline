<?php

class App {
	public $in;
	public $out;

	public function __destruct() {
		$data = [];
		foreach ($this->out as $o) {
			call_user_func_array($o, array(&$data));
		}
	}
}