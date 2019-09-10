# BLOG-API

This API was developed for the purpose of providing information for the [blog-app](https://github.com/yaakovdantas/blog-app)

## Dependencies

- PHP >= 7.2.22
- SQLITE3
- [Laravel 6.0 dependencies](https://laravel.com/docs/6.0/installation)
- Composer >= 1.8.5

### Installing
 
Clone and navigate to the root folder of this project

OS X & Linux:

```
composer install
```
* Create a database.sqlite on the root of the database folder
```
cp .env.example .env
```
Open the .env and set the database settings in the following fields:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

JWT_KEY=a_very_secret_key

LOG_CHANNEL=stack

DB_CONNECTION=sqlite
```
```
sudo php artisan key:generate
```
```
php artisan migrate:refresh --seed
```

If you want to run this project in production, open .env and set the values for the following fields:
```
APP_ENV = production
APP_DEBUG = false 
```

### Running

```
php artisan serve
```

### User guide
* **User registration**

Before taking any action in the API, it is necessary to have a registered user. To create one, just send a POST request to the endpoint **/api/register** with the following structure:

```json
{
    "name"      : "Name",
	"email"     : "email@example.com",
	"password"  : "password123",

}
```

The expected response if the user is successfully registered is like that.
```json
{
    "name": "Name",
    "email": "email@example.com",
    "updated_at": "2019-09-10 03:21:06",
    "created_at": "2019-09-10 03:21:06",
    "id": 7
}

```
* **User Login**

After create an account, send a POST request to the end point **/api/login** with the following structure:

```json
{
	"email": "email@example.com",
	"password": "password123"
}
```
If is an user valid the return it will be like this.

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRlc3RlMzRAZ21haWwuY29tIn0.UcGHQuxj5nJWBeJBKKGaw4Y2TfnbcFhQPxgpiLgMiW0"
}
```

The JWT used is Bearer token.

```json
{
    "token" "<Bearer Token>":
}
```


To perform actions on the API it is necessary that the user is authenticated. To do this, simply send a POST request to the **/api/login** endpoint with the following structure:
The expected response if the user authenticates successfully, is an authentication token with the following structure:
```json
{
	"email": "email@example.com",
	"password": "password123"
}
```


```json
{
    "token" "<Bearer Token>":
}
```

***Note: To perform any of the following actions, the authentication token must be defined in the request header:***

```json
Authorization: Bearer <Token>
```

* **Post register**

To register a new post in the database, just send a POST request to the **/api/posts** endpoint with the following structure:

```json
{
    "title":     "Title",
    "user_id:   1
}
```

* **Get posts**

To get the posts registered, simply send a GET request to one of the following endpoints:

```
/api/posts - Return all registered posts
/api/posts/{id} - Returns the post that has the given id

```

* **Get posts comments** 

To get the comments of a registered post, simply send a GET request to the following endpoit:

```
/api/posts/{id}/comments - Returns all the comments of the post that has the given id
```

* **Update post** 

To update the data of an post, simply send a PUT request to the endpoint **/api/posts/{id}**, where possible any of the fields in the structure below:

```json
{
	"title": "NewTitle",
}
```

* **Delete an post**

To delete an post, simply send a DELETE request to the following endpoint:
```
/api/posts/{id}
```

* **Register a new comment for an post**

To register a new comment for an post, just send a POST request to the endpoint **/api/comments** with the following structure:

```json
{

    "post_id": <post Id>,
    "user_id": <user Id>,
    "comment": "Lorem ipsum...",
}
```

* **Get details of an comment**

To get details of an comment, simply send a GET request to the following endpoint:

```
/api/comments/{id}
```

* **Delete an comment**

To delete an comment, simply send a DELETE request to the following endpoint:

```
/api/comments/{id}
```

* **Get users posts**

To get the all the posts of a registered user, simply send a GET request to the following endpoit:

```
/api/users/{id}/posts - Returns all the posts of the user that has the given id
```

* **Get users comments**

To get the all the comments of a registered user, simply send a GET request to the following endpoit:

```
/api/users/{id}/comments - Returns all the comments of the user that has the given id
```

## Built With

* [Laravel](https://laravel.com/) - Serve-side framework used
* [Composer](https://getcomposer.org/) - Dependency manager for PHP