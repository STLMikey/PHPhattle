<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 9/13/13
 * Time: 2:12 PM
 * To change this template use File | Settings | File Templates.
 */

namespace phattle\generators;


use phattle\models\Battlefield;
use phattle\models\Coordinate;
use phattle\models\Soldier;

class BattlefieldGenerator {

    public function generateBattlefield($x, $y) {
        $battlefield =  new Battlefield();
        $coordinates = array();
        for($i = 0; $i < $x; $i++){
            $coordinates[$i] = array();
            for($j = 0; $j < $y; $j++){
                $coordinate = new Coordinate();
                $coordinates[$i][$j] = $coordinate;
            }
        }
        $battlefield->setCoordinates($coordinates);

        return $battlefield;
    }

    public function populateBattlefield($battlefield, $armies){
        $army_a = $armies[0]->getSoldiers();
        $army_b = $armies[1]->getSoldiers();

        $start = 0;
        $position = 0;

        foreach($army_a as $soldier) {
            if($position >= $battlefield->getXSize()){
                $start++;
                $position = 0;
            }
            $battlefield->getCoordinate($start,$position++)->setSoldier($soldier);
        }

        $start = $battlefield->getXSize() - 1;
        $position = 0;
        foreach($army_b as $soldier) {
            if($position >= $battlefield->getXSize()){
                $start--;
                $position = 0;
            }
            if($battlefield->getCoordinate($start, $position)->isOccupied()){
                $position++;
            }
            $battlefield->getCoordinate($start,$position++)->setSoldier($soldier);
        }
    }





}