<?php

class ServiceLocatorTest extends PHPUnit_Framework_TestCase {

    public function testGetWillReturnUsTheInstantiatedInstance(){
        $class = '\DateTime';

        $service_locator = new \phattle\utils\ServiceLocator();
        $object = $service_locator->get($class);

        $this->assertEquals(new \DateTime(), $object);
    }

    public function testGetWillThrowExceptionIfNotFound(){
        $class = '\fartknocks\my_real_class';

        $service_locator = new \phattle\utils\ServiceLocator();
        try{
            $service_locator->get($class);
            $this->fail();
        }catch(\Exception $e){
            $this->assertEquals('Class not found', $e->getMessage());
        }
    }

    public function testGetWillAutomaticallySetItselfOnAwareInstances(){
        $class = '\phattle\utils\ServiceLocatorAwareInstance';

        $service_locator = new \phattle\utils\ServiceLocator();
        $object = $service_locator->get($class);

        $this->assertEquals($service_locator, $object->getServiceLocator());
    }

}
