<?php
namespace Buonzz\Evorg\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;


class ForceMergeSegments implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function handle()
    {
        $index_name = $this->params['index_name'];

        $client = new Client(['timeout'  => 2.0]);

        $host = config('evorg.hosts')[0]; 
        $uri = 'http://' $host . ':9200/' . $index_name . "/_forcemerge?max_num_segments=1"


        $r = $client->request('POST', $uri);

    }
}