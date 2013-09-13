<?php

namespace phattle\models;

class Soldier {
    private $hit_points = 100;
    private $damage     = 100;
    private $coordinate;

    public function setCoordinate($coordinate) {
        $this->coordinate = $coordinate;
    }

    public function getCoordinate() {
        return $this->coordinate;
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
