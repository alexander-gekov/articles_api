# Articles API

With this api you can make CRUD actions onto the collection of articles

## Installation

Clone the repository

    git clone git@github.com:alexander-gekov/articles_api.git

Switch to the repo folder

    cd articles_api

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
	
Migrate databases and seed

	php artisan migrate:fresh --seed

Start the local development server

    php artisan serve

Start making API calls to the endpoints

Check out the API documentation : [here](https://documenter.getpostman.com/view/4746181/SztA6U7J?version=latest)
