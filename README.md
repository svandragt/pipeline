# pipelines

Can web frameworks be as simple as two pipelines connected by a datastore?
Attach functions to the *in* array to process the request.
Attach functions to the *out* array to process the response.

Request > in pipeline > datastore > out pipeline > Response

Thanks ASP.NET we don't need all the plumbing.

```
cd src
php -S localhost:8080
open http://localhost:8080/test # hello Bob
```
