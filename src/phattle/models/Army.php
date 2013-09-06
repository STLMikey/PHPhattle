<?php

namespace phattle\models;

class Army {
    private $name;
    private $soldiers = array();

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setSoldiers($soldiers) {
        $this->soldiers = $soldiers;
    }

    public function getSoldiers() {
        return $this->soldiers;
    }
}
