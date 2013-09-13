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

class BattlefieldGenerator {

    public function generateBattlefield($x, $y, $armies = array()) {
        $battlefield =  new Battlefield();
        $coordinates = array();
        for($i = 0; $i < $x; $i++){
            for($j = 0; $j < $y; $j++){
                $coordinate = new Coordinate();
                $coordinate->setX($i);
                $coordinate->setY($j);
                $coordinates[] = $coordinate;
            }
        }
        $battlefield->setCoordinates($coordinates);

        return $battlefield;
    }
}