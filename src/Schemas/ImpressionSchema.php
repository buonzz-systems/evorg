<?php

namespace Buonzz\Evorg\Schemas;

use Buonzz\Evorg\Indices\SchemaMappingDecorator;

class ImpressionSchema implements SchemaInterface {

	public function getEventName(){
		return 'impression';
	}

	public function getMappings(){

		$mappings = ['element' => ["string", "not_analyzed"]];

		return $mappings;
	}
}