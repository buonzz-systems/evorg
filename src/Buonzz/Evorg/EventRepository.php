<?php namespace Buonzz\Evorg;

use \Elasticsearch\Client;
use Illuminate\Support\Collection;

class EventRepository{

	private $client;

	public function __construct(){

		$hosts = \Config::get('evorg::hosts');		
		
		$params = array();		
		$params['hosts'] = $hosts;		
		$params['logging'] =\Config::get('evorg::logging');
		$params['logPath'] = storage_path() .'/logs/evorg.log';

		$this->client = new Client($params);
	}

	public function create($eventName, $eventData){	
		
		$params = array();

		$params['body']  = $eventData;
		$params['index'] = 'events';
		$params['type']  = $eventName;		

		return $this->client->index($params);
	}

	public function get_all($event_name){

		$params = array();

		$params['body']['query']['matchAll']  = new \stdclass;
		$params['index'] = 'events';
		$params['type']  = $event_name;		

		return $this->convert_to_collection(
					$this->client->search($params)
			);	
	}

	public function read(){
		
	}

	public function update(){
		
	}

	public function delete(){
		
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