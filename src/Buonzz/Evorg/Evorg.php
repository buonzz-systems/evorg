<?php namespace Buonzz\Evorg;

use Illuminate\Support\Collection;

class Evorg {	
	
    private $current_event;
    private $repository;
    private $query;   

	public function __construct() { 
        $this->repository = new EventRepository();
	}

	public function event($event_name){    
        $this->current_event = $event_name;
        return $this;
	}
	
    public function insert($element, $params) {
        return $this->repository->create($this->current_event, $params);         
	}
        
    public function get() {
        return $this->repository->get_all($this->current_event);                  
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