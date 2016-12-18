<?php

namespace Buonzz\Evorg\Schemas;

use Buonzz\Evorg\Indices\SchemaMappingDecorator;

class ImpressionSchema implements SchemaInterface {

	public function getEventName(){
		return 'impression';
	}

	public function getMappings(){

		$mappings = ['element' => ["type" => "string", "index" => "not_analyzed"]];

		return $mappings;
	}
}