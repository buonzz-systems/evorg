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
        $params = $this->params['mappings'];
        $client = ClientFactory::getClient();

        try{
                $client->indices()->create($params);
        }
        catch(\Exception $e){
                \Log::error($e->getMessage());
        }

    }
}