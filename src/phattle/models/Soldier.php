<?php

namespace phattle\models;

class Soldier {
    private $hit_points = 100;
    private $damage     = 100;
    private $coordinate;
    private $army_name;


    public function setCoordinate($coordinate) {
        $this->coordinate = $coordinate;
    }

    public function getCoordinate() {
        return $this->coordinate;
    }

    public function setArmyName($army_name) {
        $this->army_name = $army_name;
    }

    public function getArmyName() {
        return $this->army_name;
    }


    public function setDamage($damage) {
        $this->damage = $damage;
    }

    public function getDamage() {
        return $this->damage;
    }

    public function setHitPoints($hit_points) {
        $this->hit_points = $hit_points;
    }

    public function getHitPoints() {
        return $this->hit_points;
    }
}
