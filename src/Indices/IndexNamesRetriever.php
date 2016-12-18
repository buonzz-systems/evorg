<?php

namespace Buonzz\Evorg\Indices;

use Carbon\Carbon;
use Buonzz\Evorg\ClientFactory;

class IndexNamesRetriever{
	
	private $indices;
	private $client;
	
	public function __construct($eventname){
	
		$months = config('evorg.query_months');
		$indices_tmp = [];

		$this->client  = ClientFactory::getClient();

         // add only the index names if it actually exists
		for($i=0; $i<$months; $i++)
		{
			$cur = $this->build_idx_name($i,$eventname);
			
			if($this->does_exists($cur))
				$indices_tmp[] = $cur;
		}

		$this->indices = implode(",", $indices_tmp);
	}

	private function build_idx_name($months, $eventname){
		$carbon = new Carbon();
        $carbon->subMonths($months);
     	return 		$indexname = 'evorg-events-'. config('evorg.app_id') 
			. '-' . $eventname . "-". $carbon->year . "." . $carbon->month;   
	}

	private function does_exists($index){
		$params = ['index' => $index];
		return $this->client->indices()->exists($params);
	}

	public function __toString(){
		return $this->indices;
	}
}