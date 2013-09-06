<?php

namespace phattle\utils;

class ServiceLocator {

    public function get($class ){
        if(class_exists($class)) {
            $object = new $class();
            if($object instanceof ServiceLocatorAwareInterface){
                $object->setServiceLocator($this);
            }
            return $object;
        }
        else{
            throw new \Exception('Class not found');
        }
    }

}