<?php  
require_once('__autoload.php');

$pipeline = new App;
$pipeline->out = [
	'prep',
	'myrouter'
];	


function prep(&$data) {
	$data['name'] = 'Bob';
}

function myrouter(&$data) {
	$r = new Router($data);
	$r->path_info = @$_SERVER['PATH_INFO'];
	$r->routes =  ['/test' => 'hello'];
}

function hello($data) {
	echo 'hello ' . $data['name'];
}
