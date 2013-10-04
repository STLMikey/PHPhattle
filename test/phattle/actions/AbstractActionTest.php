<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 10/4/13
 * Time: 3:33 PM
 * To change this template use File | Settings | File Templates.
 */

namespace phattle\actions;
use phattle\generators\ArmyGenerator;
use phattle\generators\BattlefieldGenerator;
use phattle\models\Coordinate;

class AbstractActionTest extends \PHPUnit_Framework_TestCase {

    private $action;

    public function setUp(){
        $this->action = $this->getMockForAbstractClass('phattle\actions\AbstractAction');
    }

    public function testCanReturnsFalseIfNoOtherSoldiersOnBattlefield(){
        $generator = new ArmyGenerator();
        $battlefiled_gen = new BattlefieldGenerator();
        $army = $generator->generateArmy('X', 1);
        $army2 = $generator->generateArmy('Y', 0);
        $battlefield = $battlefiled_gen->generateBattlefield(2,2);

        $battlefiled_gen->populateBattlefield($battlefield, array($army, $army2));

        $soldiers = $army->getSoldiers();
        $this->assertEmpty($this->action->determineTargets($soldiers[0], $battlefield));
    }

    public function testCanReturnsFalseIfEnemySoldierIsNotAdjacentToSoldier(){
        $generator = new ArmyGenerator();
        $battlefiled_gen = new BattlefieldGenerator();
        $army = $generator->generateArmy('X', 1);
        $army2 = $generator->generateArmy('Y', 1);
        $battlefield = $battlefiled_gen->generateBattlefield(3,3);

        $battlefiled_gen->populateBattlefield($battlefield, array($army, $army2));


        $soldiers = $army->getSoldiers();
        $this->assertEmpty($this->action->determineTargets($soldiers[0], $battlefield));
    }
    public function testCanReturnsAdjacentCoordinatesIfAdjacentToSoldier(){
        $generator = new ArmyGenerator();
        $battlefield_gen = new BattlefieldGenerator();
        $army = $generator->generateArmy('X', 1);
        $army2 = $generator->generateArmy('Y', 1);
        $battlefield = $battlefield_gen->generateBattlefield(2,2);

        $battlefield_gen->populateBattlefield($battlefield, array($army, $army2));

        $soldiers = $army->getSoldiers();
        $result = $this->action->determineTargets($soldiers[0], $battlefield);

        $expected_coord = $battlefield->getCoordinate(1,0);

        $this->assertCount(1,$result);
        $this->assertContains($expected_coord, $result);
    }
    public function testCanReturnsTrueIfEnemySoldierIsAdjacentToDiagonalSoldier(){
        $generator = new ArmyGenerator();
        $battlefield_gen = new BattlefieldGenerator();
        $army = $generator->generateArmy('X', 2);
        $army2 = $generator->generateArmy('Y', 1);
        $battlefield = $battlefield_gen->generateBattlefield(2,2);

        $battlefield_gen->populateBattlefield($battlefield, array($army, $army2));


        $soldiers = $army->getSoldiers();
        $result = $this->action->determineTargets($soldiers[1], $battlefield);

        $expected_coord = $battlefield->getCoordinate(1,0);
        $this->assertCount(1,$result);
        $this->assertContains($expected_coord, $result);
    }

}