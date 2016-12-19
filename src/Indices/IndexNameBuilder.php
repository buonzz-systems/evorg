<?php namespace Buonzz\Evorg\Indices;

class IndexNameBuilder{

	public function build($eventName){

		$indexname = 'evorg-events-'. \Config::get('evorg.app_id') 
			. '-' . $eventName . "-". "v1" . "-" . date("Y") . "." . date("m");

		return $indexname;
	}
}