<?php
namespace Buonzz\Evorg;

use Monolog\Logger;
use Log;
use Elasticsearch\ClientBuilder;

class ClientFactory{

	 public static function getClient(){

        $hosts = config('evorg.hosts');       
        $logging = config('evorg.logging');

        if($logging)
		{ 
       		$logger = ClientBuilder::defaultLogger( storage_path(). '/logs/evorg.log', Logger::INFO);
        	$client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                	->setHosts($hosts)      // Set the hosts
                	->setLogger($logger)
                	->build();              // Build the client object
		}
		else
		{
        	$client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                	->setHosts($hosts)      // Set the hosts
                	->build();              // Build the client object			
		}

         return $client;
	} // get client

} // factory}