<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 9/13/13
 * Time: 1:37 PM
 * To change this template use File | Settings | File Templates.
 */

namespace phattle\models;


class Battlefield {

    private $coordinates = array();

    public function setCoordinates($coordinates) {
        $this->coordinates = $coordinates;
    }

    public function getCoordinates() {
        return $this->coordinates;
    }

    public function getCoordinate($x, $y){
        return $this->coordinates[$x][$y];
    }

    public function getXSize(){
        return count($this->coordinates);
    }

    public function getYSize(){
        return count($this->coordinates[0]);
    }

    public function toString() {
        for($x = 0; $x < $this->getXSize(); $x++){
            for($y = 0; $y < $this->getYSize(); $y++){
                if($this->getCoordinate($x, $y)->isOccupied()) {
                    $soldier = $this->getCoordinate($x,$y)->getSoldier();
                    $army_name = $soldier->getArmyName();
                    echo '['.strtoupper($army_name[0]).']';
                }else{
                    echo '[-]';
                }
            }
            echo PHP_EOL;
        }
    }
}