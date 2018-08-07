<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
/**
 * To get and format parameters in query string in convenient way
 * 
 * @package app.Controller.Component
 */
class ParamComponent extends Component {
    
/**
 * @var Controller
 */
    private $controller;

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->controller = $this->_registry->getController();

    }
//    public function __construct() {
//
//        $this->controller = $this->_registry->getController();;
//    }

    public function deviceCode() {
        return $this->controller->request->header('X-Device')?:$this->controller->request->query('device_code')?:'';
    }
    

    
    public function gmt() {
        return $this->controller->request->query('gmt')?:8;
    }
    
    public function sort() {
        $sort = array();
        if(isset($this->controller->request->query['sort'])) {
        	foreach(split(',', $this->controller->request->query('sort')) as $part) {
        		$pair = split(':', trim($part));
        		$size = count($pair);
        		if($pair && $size % 2 == 0) {
        			for($i = 0; $i < $size; $i++) $sort[trim($pair[$i++])] = intval($pair[$i]);
        		}
        	}
        }
        return $sort;
    }
    
/**
 * Calculate start offset 
 * 
 * @since 3.0.0
 * @return number
 */
    public function start() {
        return ($this->page() - 1) * $this->limit();
    }
    
/**
 * @param $default 1
 * @since 2.0.0
 * @return number
 */
    public function page($default = 1) {
        return (int) $this->controller->request->getQuery('page')  ?: $default;
    }
    
/**
 * @param $default 20
 * @since 2.0.0
 * @return number
 */
    public function limit($default = 20) {
        return (int) $this->controller->request->getQuery('limit') ?: $default;
    }
    
/**
 * Split string into array
 * 
 * @param string $str
 * @return array
 */
    public function str2arr($str) {
        $str = trim($str);
        if($str) {
            return array_map('trim', explode(',', str_replace('，', ',', $str)));
        }
        return array();
    }
    
/**
 * Get point
 * 
 * @return \Model\Data\Point|NULL
 */
    public function point() {
        $latitude  = $this->controller->request->query('latitude');
        $longitude = $this->controller->request->query('longitude');
        
        if($latitude && $longitude) {
            $point = new \Model\Data\Point($longitude , $latitude);
            return $point;
        }
        
        return null;
    }
    
    /**
     * extra point
     * @return boolean
     */
    public function ep() {
        return (bool) $this->controller->request->header('X-EP');
    }
}