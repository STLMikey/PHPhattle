<?php

namespace phattle\actions;

use phattle\generators\ArmyGenerator;
use phattle\generators\BattlefieldGenerator;
use phattle\models\Coordinate;
use phattle\models\Soldier;

class AttackTest extends AbstractActionTest {

    public function setUp(){
        parent::setUp();
    }

    public function testAttackIsAnAction() {
        $attack = new Attack();
        $this->assertInstanceOf('phattle\actions\AbstractAction', $attack);
    }

    public function testExecuteDealsDamageToEnemySoldier(){
        $attack   = new Attack();
        $soldier = new Soldier();
        $enemy = new Soldier();
        $soldier->setDamage(25);

        $coordinate = new Coordinate();
        $coordinate->setSoldier($enemy);

        $attack->execute($soldier, $coordinate);

        $enemy = $coordinate->getSoldier();

        $this->assertEquals(75, $enemy->getHitPoints());
    }

    public function testExecuteDealsDamageToEnemySoldierEqualToTheDamageTheSoldierCanDeal(){
        $attack   = new Attack();
        $soldier = new Soldier();
        $enemy = new Soldier();
        $soldier->setDamage(50);

        $coordinate = new Coordinate();
        $coordinate->setSoldier($enemy);

        $attack->execute($soldier, $coordinate);

        $enemy = $coordinate->getSoldier();

        $this->assertEquals(50, $enemy->getHitPoints());
    }


    //damage compounds with previous damage
    public function testDamageCompoundsWithEachExecution(){
        $attack   = new Attack();
        $soldier = new Soldier();
        $enemy = new Soldier();
        $soldier->setDamage(25);

        $coordinate = new Coordinate();
        $coordinate->setSoldier($enemy);

        $attack->execute($soldier, $coordinate);
        $attack->execute($soldier, $coordinate);

        $enemy = $coordinate->getSoldier();

        $this->assertEquals(50, $enemy->getHitPoints());
    }
    //when damage goes negative, soldier is removed from coordinate
    public function testWhenSoldierTakesEnoughDamageRemoveHimFromTheCoordinate(){
        $attack   = new Attack();
        $soldier = new Soldier();
        $enemy = new Soldier();
        $enemy->setHitPoints(1);
        $soldier->setDamage(25);

        $coordinate = new Coordinate();
        $coordinate->setSoldier($enemy);

        $attack->execute($soldier, $coordinate);

        $enemy = $coordinate->getSoldier();
        $this->assertNull($enemy);
//        $this->assertEquals(50, $enemy->getHitPoints());
    }
}
