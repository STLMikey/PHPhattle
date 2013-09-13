<?php

namespace test\phattle\generators;

use phattle\generators\ArmyGenerator;

class ArmyGeneratorTest extends \PHPUnit_Framework_TestCase {

    /** @var  \phattle\generators\ArmyGenerator */
    protected $generator;

    public function setUp() {
        $this->generator = new ArmyGenerator();
    }

    public function testGenerateArmyReturnsArmy() {

        $actual = $this->generator->generateArmy(null, null);

        $this->assertInstanceOf('phattle\models\Army', $actual);
    }

    public function testGeneratedArmyHasAName(){
        $name = 'Putie and the Blowfish';
        $actual = $this->generator->generateArmy($name, null);

        $this->assertEquals($name, $actual->getName());
    }

    public function testGeneratedArmyHasSoldiers() {
        $name = 'KGB Soundsystem';
        $actual = $this->generator->generateArmy($name, 1);

        $this->assertGreaterThan(0, count($actual->getSoldiers()));
    }

    public function testGetSoldiersOnlyReturnsSoldiers(){
        $name = 'Rush-uh';
        $actual = $this->generator->generateArmy($name, 2);

        foreach($actual->getSoldiers() as $soldier){
            $this->assertInstanceOf('phattle\models\Soldier', $soldier);
        }
    }
    public function testGetSoldiersReturnsCorrectNumberOfSoldiers() {
        $name = "Vlad Religion";
        $expected_size = 2;
        $actual = $this->generator->generateArmy($name, $expected_size);

        $this->assertEquals($expected_size, count($actual->getSoldiers()));
    }


}