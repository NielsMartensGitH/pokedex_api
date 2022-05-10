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

````
php artisan migrate:fresh --seed
````

6) Run the application:

````
php artisan serve
````
