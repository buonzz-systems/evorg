<?php
namespace Buonzz\Evorg\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Elasticsearch\ClientBuilder;
use Buonzz\Evorg\ClientFactory;

class CreateIndexSchema implements ShouldQueue
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
        $client = ClientFactory::getClient();
        $response = $client->index($params);
    }
}