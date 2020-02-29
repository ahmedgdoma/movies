# Movies API

This project was generated with [Laravel](https://laravel.com/) version 5.8.*

## How to Setup

To get this system working you have to have the following prerequisites installed:
[docker](https://www.docker.com/),
[docker compose](https://docs.docker.com/compose/).

clone the project
then run
`cd path/to/project && docker-compose -d
`

Check phpMyAdmin [click here](http://localhost:8883),
username: `root`, password: `ahmed`
Our Working Database is `movies`

Then open the project [click here](http://0.0.0.0:8881),

login with email: `admin@movies.dev`,and password: `dev123456`

after login you see the token created for API you can change to token by clicking update token

and you can change configuration by button Update Configurations

You need to Add [movies Api](https://themoviedb.org/) in `.env` file field `MOVIES_API_KEY`


you can also login in API `POST`  `http://localhost:8881/api-login`

 Headers: `Content-Type: application/json`
 
 Body: `{"email":"admin@movies.dev", "password": "dev123456"}`
 
 and it retrieves API Token
 
 API Return User Data `GET`  `http://localhost:8881/api/user`
 
 Header 1: `Content-Type: application/json`
 
Header 2: `Accept: application/json`
 
Header 3: `Authorization: Bearer yourToken`

to view genres returned from API

 API  `GET`  `http://localhost:8881/api/get-genres`
 
 Header 1: `Content-Type: application/json`
 
Header 2: `Accept: application/json`
 
Header 3: `Authorization: Bearer yourToken`

to view Top Rated Movies returned from API

 API  `GET`  `http://localhost:8881/api/get-top-rated-movies`
 
 Header 1: `Content-Type: application/json`
 
Header 2: `Accept: application/json`
 
Header 3: `Authorization: Bearer yourToken`

to view Recent Movies returned from API

 API  `GET`  `http://localhost:8881/api/get-recent-movies`
 
 Header 1: `Content-Type: application/json`
 
Header 2: `Accept: application/json`
 
Header 3: `Authorization: Bearer yourToken`

You can add filters and sort for Last two APIs

######filters:
title -> subString from title (type = string)

id -> accurate movie by id (type = int)

rate -> which have rate greater than (type = int)

popularity -> which have popularity greater than (type = int)

category_id -> filter by genre id  (type = int)

######sorts:

you can sort by any data retrieved ascending or descending

EXAMPLE: `title|asc`, `rate|desc` 
or mix sorts like `rate|asc&popularity|desc&title|desc`

####Testing

To run testing please run

 `docker container exec -it movies_laravel_1 /bin/bash`
 then in the inner terminal run
 `./vendor/bin/phpunit`





