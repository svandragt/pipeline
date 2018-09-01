<?php
require_once( '__autoload.php' );

$pipeline = new App();
$pipeline->connect_to( 'router' );
$pipeline->connect_to( 'prep_data', 'router' );

function prep_data( &$data ) {
	$data['name'] = 'Bob';
}

function router( &$data ) {
	$r            = new Router( $data );
	$r->path_info = @$_SERVER['PATH_INFO'];
	$r->routes    = [ '/test' => 'hello' ];
}

function hello( $data ) {
	echo 'hello ' . $data['name'];
}
