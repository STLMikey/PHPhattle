<?php

namespace phattle\actions;

class Attack extends AbstractAction {

    public function execute($soldier, $coordinate) {
        /** @var  $enemy \phattle\models\Soldier*/
        /** @var  $coordinate \phattle\models\Coordinate*/

        $enemy = $coordinate->getSoldier();
        $enemy->takeDamage($soldier->getDamage());

        if($enemy->getHitPoints() <= 0) {
            $coordinate->setSoldier(null);
        }
    }

}