<?php
require_once( '__autoload.php' );

$pipeline = new Pipeline();
$pipeline->add( 'router' );
$pipeline->add_before( 'prep_data', 'router' );

function router( &$data ) {
	$r = new Router( $data );
	$r->add( [ '/hello' => 'hello_view' ] );
}

function prep_data( &$data ) {
	$data['name'] = 'Bob1';
}

function hello_view( $data ) {
	echo 'hello ' . $data['name'];
}
