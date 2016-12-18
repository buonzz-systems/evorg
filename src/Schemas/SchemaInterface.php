<?php

namespace Buonzz\Evorg\Schemas;

interface SchemaInterface {
	public function getEventName();
	public function getMappings();
}