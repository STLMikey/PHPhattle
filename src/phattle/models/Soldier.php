<?php

namespace phattle\models;

class Soldier {

    private $hit_points;
    private $position;
    private $damage;

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

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getPosition() {
        return $this->position;
    }
}
