<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 9/13/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */

namespace test\phattle\generators;


use phattle\generators\ArmyGenerator;
use phattle\generators\BattlefieldGenerator;
use phattle\models\Coordinate;

class BattlefieldGeneratorTest extends \PHPUnit_Framework_TestCase {

    /** @var  \phattle\generators\BattlefieldGenerator */
    protected $generator;

    public function setUp() {
        $this->generator = new BattlefieldGenerator();
    }

    public function testGenerateBattlefieldReturnsBattlefield() {
        $actual = $this->generator->generateBattlefield(0,0);
        $this->assertInstanceOf('\phattle\models\Battlefield', $actual);
    }

    public function testGeneratedBattleHasCoordinatesOfSize1x1(){
        $expected = array(array(new Coordinate()));

        $actual = $this->generator->generateBattlefield(1,1);
        $this->assertEquals($expected, $actual->getCoordinates());
    }

    public function testGeneratedBattlefieldHasProperNumberOfCoordinates() {
        $coordinates[0][0] = new Coordinate();
        $coordinates[0][1] = new Coordinate();
        $coordinates[1][0] = new Coordinate();
        $coordinates[1][1] = new Coordinate();


        $actual = $this->generator->generateBattlefield(2,2);

        $this->assertEquals($coordinates, $actual->getCoordinates());
    }

    public function testPopulateBattleFieldWillPlaceSoldiersOnTheBattlefield(){
        $battlefield = $this->generator->generateBattlefield(2,2);

        $army_generator = new ArmyGenerator();
        $army_1 = $army_generator->generateArmy('What does the fox say', 1);
        $army_2 = $army_generator->generateArmy('Ringdingdingdingedingdingding', 1);

        $this->generator->populateBattlefield($battlefield, array($army_1, $army_2));

        $populated = false;
        for($i = 0; $i < $battlefield->getXSize(); $i++){
            for($j = 0; $j < $battlefield->getYSize(); $j++){
                $coordinate = $battlefield->getCoordinate($i, $j);
                if($coordinate->getSoldier()){
                    $populated = true;
                }
            }
        }

        $this->assertTrue($populated);
    }

    public function testPopulateBattleFieldWillPlaceSoldiersFromBothArmies() {
        // [A][]
        // [B][]
        $battlefield = $this->generator->generateBattlefield(2,2);

        $army_generator = new ArmyGenerator();
        $army_1 = $army_generator->generateArmy('What does the fish say', 1);
        $army_2 = $army_generator->generateArmy('blub', 1);

        $this->generator->populateBattlefield($battlefield, array($army_1, $army_2));

        $this->assertNotNull($battlefield->getCoordinate(0,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(1,0)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(0,1)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(1,1)->getSoldier());
    }

    public function testPopulateBattleFieldWillPlaceSoldiersFromBothArmiesEvenly() {
        // [A][A]
        // [B][B]
        $battlefield = $this->generator->generateBattlefield(2,2);

        $army_generator = new ArmyGenerator();
        $army_1 = $army_generator->generateArmy('What does the fish say', 2);
        $army_2 = $army_generator->generateArmy('blub', 2);

        $this->generator->populateBattlefield($battlefield, array($army_1, $army_2));

        $this->assertNotNull($battlefield->getCoordinate(0,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(1,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(0,1)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(1,1)->getSoldier());
    }

    public function testPopulateBattlefieldWillWorkOnBattlefieldsGreaterThanTwoByTwo() {
        // [A][A][-]
        // [-][-][-]
        // [B][B][-]
        $battlefield = $this->generator->generateBattlefield(3,3);

        $army_generator = new ArmyGenerator();
        $army_1 = $army_generator->generateArmy('what does the elephant say', 2);
        $army_2 = $army_generator->generateArmy('toot', 2);

        $this->generator->populateBattlefield($battlefield, array($army_1, $army_2));

        $this->assertNotNull($battlefield->getCoordinate(0,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(0,1)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(0,2)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(1,0)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(1,1)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(1,2)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(2,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(2,1)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(2,2)->getSoldier());
    }

    public function testPopulateBattlefieldWillWorkOnBattlefieldsGreaterThanTwoByTwoWithMorSoldiersThanRows() {
        // [A][A][A]
        // [A][B][-]
        // [B][B][B]
        $battlefield = $this->generator->generateBattlefield(3,3);

        $army_generator = new ArmyGenerator();
        $army_1 = $army_generator->generateArmy('what does the elephant say', 4);
        $army_2 = $army_generator->generateArmy('toot', 4);

        $this->generator->populateBattlefield($battlefield, array($army_1, $army_2));

        $this->assertNotNull($battlefield->getCoordinate(0,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(0,1)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(0,2)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(1,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(1,1)->getSoldier());
        $this->assertNull($battlefield->getCoordinate(1,2)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(2,0)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(2,1)->getSoldier());
        $this->assertNotNull($battlefield->getCoordinate(2,2)->getSoldier());
    }
}