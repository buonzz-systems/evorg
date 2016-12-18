<?php namespace Buonzz\Evorg;


use Buonzz\Evorg\Jobs\SaveEvent;
use Buonzz\Evorg\Indices\IndexNameBuilder;
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;

class EventRepository{

	private $idxbuilder;
	private $agent;

	public function __construct(){
   		$this->idxbuilder = new IndexNameBuilder();
   		$this->agent = new Agent();
	}

	public function create($eventName, $eventData){		

		$indexname = $this->idxbuilder->build($eventName);

		if(!isset($eventData['timestamp']))
			$eventData['timestamp'] = date("c");

		if(!isset($eventData['ip']))
			$eventData['ip'] = request()->ip();

		if(!isset($eventData['user_agent']))
			$eventData['user_agent'] = request()->header('User-Agent');

		$params = [
	        'indexname' => $indexname,
	        'eventName' => $eventName,
	        'eventData' => $eventData
	    ];

	    // dont record event if robot
	    if(!$agent->isRobot())
	    	dispatch( new SaveEvent($params));

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