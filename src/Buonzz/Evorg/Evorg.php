<?php namespace Buonzz\Evorg;

use Illuminate\Support\Collection;

class Tracking {	
	
    private $current_event;
    private $repository;
    private $query;   

	public function __construct() { 
        $this->repository = new EventRepository();
	}

	public static function event($event_name){    
        $this->current_event = $event_name;
        return $this;
	}
	
    public function insert($element, $params) {             
	}
        
    public function get() {                
    }
    
    public function first() {            
        
    }
    
    public function pluck($name) {            
        
    }
    
    public function select() {
        
    }
    
    public function addSelect($attribute) {
        
    }
    
    public function distinct() {
        
    }
    
    public function lists($attribute, $keyColumn = null) {            
        
    }
    
    public function where($attribute, $operator, $value) {
        
    }  

    // @todo
    public function orWhere($attribute, $operator, $value) {
    
    }
    
    public function whereBetween($attribute, array $values) {
        
    }
    
    public function whereNotBetween($attribute, array $values) {
        
    }
    
    public function whereIn($attribute, array $values) {
        
    }
    
    public function whereNotIn($attribute, array $values) {
        
    }
    
    public function whereNull($attribute) {
        
    }
    
    public function orderBy($attribute, $order) {
        
    }
    
    public function groupBy($attribute) {
        
    }
    
    public function having($attribute, $operator, $value) {
        
    }
    public function skip($num) {
        
    }
    
    public function take($num) {
        
    }
    
    public function count() {
        
    }
}