# pipelines

Can web frameworks be as simple as two pipelines connected by a datastore?
Attach functions to the ordered *in* array to process the request.
A datastore in the middle.
Attach functions to the ordered *out* array to prepare the response.

_Request > in pipeline > datastore > out pipeline > Response_

The idea is to end up somewhere between ASP.NET MVC setup and WordPress action/filter/hooks but in an orderly fashion. This allows a micro framework to expose points for functionality to hook into.

The problem with the WordPress way is that code is all over the place, hooking into a multitude of places. The problem with ASP.NET MVC is that even Super Mario gets ADHD from all the plumbing and interfaces that are required.

Let's see if a micro solution is possible.

```
cd src
php -S localhost:8080
open http://localhost:8080/test # hello Bob
```
