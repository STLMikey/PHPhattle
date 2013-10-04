<?php

namespace phattle\actions;

use phattle\generators\ArmyGenerator;
use phattle\generators\BattlefieldGenerator;
use phattle\models\Coordinate;

class AttackTest extends AbstractActionTest {

    public function setUp(){
        parent::setUp();
    }
    public function testAttackIsAnAction() {
        $attack = new Attack();
        $this->assertInstanceOf('phattle\actions\AbstractAction', $attack);
    }

}
