<?php
namespace Buonzz\Evorg\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Elasticsearch\ClientBuilder;
use Buonzz\Evorg\ClientFactory;

class CreateIndexTemplate implements ShouldQueue
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

        // get the index name and unset it
        $template_name = $params['index'];
        unset($params['index']);

        // strip off the dates
        $template_name = substr($string, 0, -7);

        $params['name'] => 'evorg-' . md5($template_name);
        $params['body']['template'] = $template_name . "*";

        $client = ClientFactory::getClient();

        try{
                $client->indices()->putTemplate($params);
        }
        catch(\Exception $e){
                \Log::error($e->getMessage());
        }

    }
}