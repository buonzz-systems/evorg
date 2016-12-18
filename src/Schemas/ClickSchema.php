<?php

namespace Buonzz\Evorg\Schemas;

use Buonzz\Evorg\Indices\SchemaMappingDecorator;

class ClickSchema implements SchemaInterface {

	public function getEventName(){
		return 'click';
	}

	public function getMappings(){

		$mappings = ['element' => ["type" => "string",  "index" => "not_analyzed"]];

		return $mappings;
	}
}