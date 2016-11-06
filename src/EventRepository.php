<?php namespace Buonzz\Evorg;

use Elasticsearch\ClientBuilder;
use Monolog\Logger;

use Illuminate\Support\Collection;

class EventRepository{

	private $client;
	private $idxbuilder;

	public function __construct(){

		$hosts = \Config::get('evorg.hosts');		
		$logger = ClientBuilder::defaultLogger( storage_path(). '/logs/evorg.log', Logger::INFO);

    	$this->client = ClientBuilder::create()   // Instantiate a new ClientBuilder
                ->setHosts($hosts)      // Set the hosts
                ->setLogger($logger)
                ->build();              // Build the client object

   		$this->idxbuilder = new IndexNameBuilder();
	}

	public function create($eventName, $eventData){		

		$indexname = $this->idxbuilder->build($eventName);

		if(!isset($eventData['timestamp']))
			$eventData['timestamp'] = date("c");

		$params = [
	        'index' => $indexname,
	        'type' => $eventName,
	        'body' => $eventData
	    ];

		$response = $this->client->index($params);

	} // create

	public function get_all($event_name){
	}

	public function read(){
		
	}

	public function update(){
		
	}

	public function delete($eventName){
		$params = [
				'index' => $this->idxbuilder->build($eventName)
		];

        $response = $this->client->indices()->delete($params);
	}

	private function convert_to_collection($search_result){
		
		$data = $search_result['hits']['hits'];
        $tmp = array();
        if(is_array($data))
        {
            foreach($data as $item)
            {
                    $cur_item = $item['_source'];
                    $cur_item['id'] =  $item['_id'];
                    $tmp[] = $cur_item;
            }
        }
        else
                $tmp[] =  $data['_source'];
        return new Collection($tmp);
	}
}