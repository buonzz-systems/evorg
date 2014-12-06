<?php namespace Buonzz\Evorg;

use \Elasticsearch\Client;

class EventRepository{
	private $client;

	public function __construct(){
		$hosts = \Config::get('evorg::hosts');		
		$params = array();
		$params['hosts'] = $hosts;
		$this->client = new Client($params);
	}

	public function create($eventName, $eventData){	
		$params = array();
		$params['body']  = $eventData;
		$params['index'] = $eventName;
		$params['type']  = $eventName;		
		return $this->client->index($params);
	}

	public function read(){
		
	}

	public function update(){
		
	}

	public function delete(){
		
	}
}