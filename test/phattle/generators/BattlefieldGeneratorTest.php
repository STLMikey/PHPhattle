<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mike.roof
 * Date: 9/13/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */

namespace test\phattle\generators;


use phattle\generators\BattlefieldGenerator;
use phattle\models\Coordinate;

class BattlefieldGeneratorTest extends \PHPUnit_Framework_TestCase {

    /** @var  \phattle\generators\BattlefieldGenerator */
    protected $generator;

    public function setUp() {
        $this->generator = new BattlefieldGenerator();
    }

    public function testGenerateBattlefieldReturnsBattlefield() {
        $actual = $this->generator->generateBattlefield(0,0,array());
        $this->assertInstanceOf('\phattle\models\Battlefield', $actual);
    }

    public function testGeneratedBattleHasCoordinatesOfSize1x1(){
        $coordinate =  $this->createCoordinate(0,0);
        $expected = array($coordinate);

        $actual = $this->generator->generateBattlefield(1,1,array());
        $this->assertEquals($expected, $actual->getCoordinates());
    }

    public function testGeneratedBattlefieldHasProperNumberOfCoordinates() {
        $coordinates = array();
        $coordinates[] = $this->createCoordinate(0,0);
        $coordinates[] = $this->createCoordinate(0,1);
        $coordinates[] = $this->createCoordinate(1,0);
        $coordinates[] = $this->createCoordinate(1,1);

        $expected = $coordinates;

        $actual = $this->generator->generateBattlefield(2,2,array());

        $this->assertEquals($expected, $actual->getCoordinates());
    }

    public function createCoordinate($x, $y) {
        $coordinate = new Coordinate();
        $coordinate->setX($x);
        $coordinate->setY($y);

        return $coordinate;
    }
}