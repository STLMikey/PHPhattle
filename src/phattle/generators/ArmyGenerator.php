<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 9/13/13
 * Time: 1:45 PM
 * To change this template use File | Settings | File Templates.
 */
namespace phattle\generators;

use phattle\models\Army;
use phattle\models\Soldier;

class ArmyGenerator {

    public function generateArmy($name, $size = 1){
        $army =  new Army();
        $army->setName($name);
        $soldiers = array();
        for($i = 0; $i < $size; $i++){
            $soldiers[] = new Soldier();
        }
        $army->setSoldiers($soldiers);

        return $army;
    }

}