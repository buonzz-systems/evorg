<?php namespace Buonzz\Evorg;

use \Elasticsearch\Client;

class EventRepository{

	public function __construct(){
		$hosts = \Config::get('evorg::hosts');		
		$params = array();
		$params['hosts'] = $hosts;
		$client = new Client($params);
	}
	public function create(){

	}

	public function read(){
		
	}

	public function update(){
		
	}

	public function delete(){
		
	}
}