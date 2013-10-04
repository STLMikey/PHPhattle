<?php

namespace phattle\actions;

class Attack {

    public function determineTargets($soldier, $battlefield){
        $coordinates = array();
        if($this->isEnemyOnBattlefield($soldier, $battlefield)){
            $coordinates = $this->isEnemyAdjacent($soldier, $battlefield);
        }
        return $coordinates;
    }

    public function execute($soldier, $battlefield) {
        //select
    }

    private function isEnemyOnBattlefield($soldier, $battlefield) {
        $unique_armies = array();
        for($x = 0; $x < $battlefield->getXSize(); $x++){
            for($y = 0; $y < $battlefield->getYSize(); $y++){
                $coord = $battlefield->getCoordinate($x, $y);
                if($coord->isOccupied()){
                    $soldier = $coord->getSoldier();
                    $unique_armies[$soldier->getArmyName()] = true;
                }
            }
        }
        return count($unique_armies) >= 2;
    }


    private function isEnemyAdjacent($soldier, $battlefield) {
        $position = $soldier->getPosition();

        $adjacent_coords = $this->findAdjacentCoordinates($battlefield, $position);
        $coordinates = array();
        foreach($adjacent_coords as $coord) {
            if($coord->isOccupied()){
                $new_soldier = $coord->getSoldier();
                if($new_soldier->getArmyName() != $soldier->getArmyName()){
                    $coordinates[] = $coord;
                }
            }
        }
        return $coordinates;
    }

    private function findAdjacentCoordinates($battlefield, $position) {
        $x = $position['x'];
        $y = $position['y'];
        $adjacent_coords = array();

        for($i = $x-1; $i <= $x+1; $i++){
            for($j = $y-1; $j <= $y+1; $j++){
                if($i >= 0 && $i < $battlefield->getXSize() && $j >=0 && $j < $battlefield->getYSize()){
                    $adjacent_coords[] = $battlefield->getCoordinate($i, $j);
                }
            }
        }

        return $adjacent_coords;
    }
}