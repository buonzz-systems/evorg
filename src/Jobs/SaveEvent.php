<?php
namespace Buonzz\Evorg\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Buonzz\Evorg\ClientFactory;

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
            'body' => $this->params['eventData'],
            'client' => [
                'timeout' => config('evorg.query_timeout') , 
                'connect_timeout' => config('evorg.connect_timeout')
            ]
        ];

        try{
        
            $client = ClientFactory::getClient();        
            $response = $client->index($params);
        }
        catch(\Exception $e){
            \Log::error('Save Event: ' . $e->getMessage(););
        }
    }
}