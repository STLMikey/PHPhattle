<?php

namespace phattle\utils;

class ServiceLocatorAwareInstance implements \phattle\utils\ServiceLocatorAwareInterface{

    protected $service_locator;

    function getServiceLocator() {
        return $this->service_locator;
    }

    function setServiceLocator($service_locator) {
        $this->service_locator = $service_locator;
    }
}