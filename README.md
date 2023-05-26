###Vocation
Practice with RESTfull APi, OpenApi-swagger specification, protection by Sanctum, request validation.

###Description
Project "Storage of the categories in DB with manipulation through REST API". 
DB stores a lot of names of category. Remote user can (using API) get registered, login/logout
and manipulate the data:
* see all categories
* see category by id
* create new category
* update category by id
* delete category by id
* delete all the categories

This actions are protected from unauthenticated user. Every request to protected actions(endpoints, routes) is 
checked for bearer token using behind Sanctum.

Specification based on annotations in classes hierarchy. Specification allows: to see input, output interfaces;
to input the data, make request and watch the result.

###How to run
* clone the repository
* rename project to 74
* ```docker-compose up -d```
*  ```docker exec -it 74_php-apache_1 bash```
*  ```composer update --no-scripts```
*  ```php artisan key:generate```
*  ```php artisan optimize```
* ```php artisan migrate --seed```
*  ```Open in browser http://localhost/api/docs```
* Authorize with email: user@example.com password: password
