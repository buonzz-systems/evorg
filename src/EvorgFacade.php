<?php namespace Buonzz\Evorg;

use Illuminate\Support\Facades\Facade;

class EvorgFacade extends Facade{   
   protected static function getFacadeAccessor(){ return 'evorg';}
}