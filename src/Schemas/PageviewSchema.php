<?php

namespace Buonzz\Evorg\Schemas;

use Buonzz\Evorg\Indices\SchemaMappingDecorator;

class PageviewSchema implements SchemaInterface {

	public function getEventName(){
		return 'pageview';
	}

	public function getMappings(){

		$mappings = ['page' => ["type" => "string", "index" => "not_analyzed"]];

		return $mappings;
	}
}