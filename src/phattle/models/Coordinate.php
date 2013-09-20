<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 9/13/13
 * Time: 1:42 PM
 * To change this template use File | Settings | File Templates.
 */

namespace phattle\models;


class Coordinate {
    private $soldier;

    public function isOccupied(){
        return $this->soldier != null;
    }

    public function setSoldier($soldier) {
        $this->soldier = $soldier;
    }

    public function getSoldier() {
        return $this->soldier;
    }


}