<p  align="center"><img  src="https://media.sketchfab.com/models/c0f06e60af0b4f22a28104d9444835ea/thumbnails/f7f4eaca8ef34a89ac6f01ab05b69202/b063407534574bbc9a3f8df2df62adbf.jpeg"  width="200"></p>

  
  

## Pokedex API

  

  

This is a simple pokedex API made with Laravel. You can data seed all pokemon from the first generation but you can also easily add pokemon from other generations. You just have to register and create a bearer token on the dashboard.

  

## Setup

  

1) Clone this repository and go to file directory

  

2) Install composer dependencies:

```

composer install

```

3) Go to '.env.example' and change this to '.env'

4) Also in '.env' change the following:

````

APP_URL=http://localhost:8000

DB_DATABASE=pokemon_api

DB_USERNAME= {your DB username}

DB_PASSWORD= {your DB password}

````

  

5) Do the migrations and execute all seeders for dumping pokemon data:
***Please be patient. This command can take around 6 to 8 minutes to complete because it will dump a huge amount of data.***

  

````

php artisan migrate:fresh --seed

````

 6) Generate App Key
```
php artisan key:generate
``` 

7) Run the application:

  

````

php artisan serve

````

## What you get:

When you first enter the application you can register your account which directly lead you to the dashboard. There you have following options:

- Create a bearer token
	* Some endpoints of the api need a token otherwise you will not be authorized. You can also add your created token on the documentation page or use it in your API platform like for example 'postman'
* Test your endpoints on the documentation page
* Import a new pokemon from external pokeapi service by entering a 'name' or 'id'. The external data comes directly from https://pokeapi.co 
