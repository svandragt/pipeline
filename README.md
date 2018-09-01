# Pipeline

Can web frameworks be as simple as a pipeline connecting multiple pipes?
Attach functions before and after others to process the request and prepare the response.

_Request > stuff  > datastore > stuff > Response_

# Philosophy

The idea is to end up somewhere between ASP.NET MVC setup and WordPress action/filter/hooks but in an orderly fashion. This allows a micro framework to expose points for functionality to hook into.

The problem with the WordPress way is that code is all over the place, hooking into a multitude of places. The problem with ASP.NET MVC is that even Super Mario gets ADHD from all the plumbing and interfaces that are required.

Let's see if a micro solution is possible.

* I like object oriented programming for the supplied features (App, Router) but creating an integration will be functional.
* Pipelines are arrays of function names which are called by the main App class.
* We're all adults so we're  exposing public properties directly doing away with getters and setters.
* Composition is all currently done  in the `__destruct()` method of classes, this means we don't have to worry about ->show() and ->run() methods.
* The IN pipeline will have to do some messaging of the request, perhaps passing an array by reference into the datastore.
* The OUT pipeline must do something similar with the data, handing it over from function to function until it's spit out.

Figuring things out as i go.


```
cd src
php -S localhost:8080
open http://localhost:8080/test # hello Bob
```
