<?php namespace Abhi\Tangocard\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Tangocard extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'tangocard'; }
 
}