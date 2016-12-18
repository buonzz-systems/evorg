<?php
namespace Buonzz\Evorg;

use Monolog\Logger;
use Log;
use Elasticsearch\ClientBuilder;

class ClientFactory{

	 public static function getClient(){

        $hosts = \Config::get('evorg.hosts');       
        $logger = ClientBuilder::defaultLogger( storage_path(). '/logs/evorg.log', Logger::INFO);

        $client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                ->setHosts($hosts)      // Set the hosts
                ->setLogger($logger)
                ->build();              // Build the client object
         return $client;
	 }
}