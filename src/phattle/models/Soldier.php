<?php

namespace phattle\models;

class Soldier {
    private $hit_points = 100;
    private $damage     = 100;
    private $army_name;
    private $position;

    public function setPosition($x, $y) {
        $this->position = array('x' => $x, 'y' => $y);
    }

    public function getPosition() {
        return $this->position;
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

    public function takeDamage($damage){
        $this->hit_points = $this->hit_points - $damage;
    }
}
