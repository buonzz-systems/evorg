<?php
namespace Buonzz\Evorg\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;
use Elasticsearch\ClientBuilder;
use Monolog\Logger;

class SaveEvent implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function handle()
    {
        $params = [
            'index' => $this->params['indexname'],
            'type' => $this->params['eventName'],
            'body' => $this->params['eventData']
        ];

        $hosts = \Config::get('evorg.hosts');       
        $logger = ClientBuilder::defaultLogger( storage_path(). '/logs/evorg.log', Logger::INFO);

        $client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                ->setHosts($hosts)      // Set the hosts
                ->setLogger($logger)
                ->build();              // Build the client object

        $response = $client->index($params);
    }
}