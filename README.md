# Codename Pipeline

Can a web frameworks be as simple as a stack of callbacks? 
Attach functions before and after others to process the request and prepare the response.

_Request > stuff  > datastore > stuff > Response_

```php
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
```

# Philosophy

The idea is to end up somewhere between ASP.NET MVC setup and WordPress action/filter/hooks but in an orderly fashion. This allows a micro framework to expose points for functionality to hook into.

The problem with the WordPress way is that code is all over the place, hooking into a multitude of places. The problem with ASP.NET MVC is that even Super Mario gets ADHD from all the plumbing and interfaces that are required.

Let's see if a micro solution is possible.

* I'd like  to object oriented programming for the supplied framework features (Pipeline, Router) but that creating an integration project will be functional programmed.
* Pipelines are arrays of function names which are called by the main Pipeline class.
* We're all adults so we're exposing public properties directly doing away with getters and setters.
* Composition is all currently done  in the `__destruct()` method of classes, this means we don't have to worry about ->show() and ->run() methods.

Figuring the rest out as i go.


```
cd src
php -S localhost:8080
open http://localhost:8080/hello # hello Bob
```
