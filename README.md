# pipelines

Can web frameworks be as simple as two pipelines connected by a datastore?
Attach functions to the ordered *in* array to process the request.
Attach functions to the ordered *out* array to prepare the response.

_Request > in pipeline > datastore > out pipeline > Response_

Thanks ASP.NET MVC but we don't need all the plumbing.

```
cd src
php -S localhost:8080
open http://localhost:8080/test # hello Bob
```
