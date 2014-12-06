Evorg
=====

Scalable Events Database for Laravel

### Requirements

* cURL
* PHP >= 5.4.0
* ElasticSearch Servers

### Installation

require in composer.json

    "buonzz/evorg": "dev-master"

update composer by executing this in your project base folder

    composer update

add the service provider in app/config/app.php in providers array

    'Buonzz\Evorg\EvorgServiceProvider',

add the Facade objects in app/config/app.php in aliases array

    'Evorg'   => 'Buonzz\Evorg\EvorgFacade'
    
publish the config settings

    php artisan config:publish buonzz/evorg

edit app/config/packages/buonzz/evorg/config.php

* app_id - is a unique number to identify your app
* app_name - is the unique name of your app
* hosts - address of the elasticsearch servers (see http://www.elasticsearch.org/guide/en/elasticsearch/client/php-api/current/_configuration.html)


### Usage

Insert a click for a particular thumbnail

```
Route::get('click', function()
{
	return Evorg::event("click")
				   ->insert('thumbnail', array(
					    'movie_name' => 'Interstellar',
						  'year' => '2014')
				);
});
```
