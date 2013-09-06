<?php

namespace phattle\utils;

interface ServiceLocatorAwareInterface {

    function getServiceLocator();

    function setServiceLocator($service_locator);

}