<?php
namespace StjepanBrbot;

use StjepanBrbot\Matrix;
use StjepanBrbot\MLR;

include 'compareArrays.php';

class MLRTest extends \PHPUnit_Framework_TestCase
{

  protected $MLR;

  protected function setUp()
  {
    $X=[[1,3,3],
        [2,3,1],
        [2,4,2],
        [3,3,4]];
    $Y=  [[3],
          [2],
          [4],
          [3]];
    $this->MLR=new MLR($X,$Y);
  }

  protected function tearDown()
  {

  }

  public function testGetCoefficients()
  {
    $C=[-2.8,-0.2,1.6,0.4];
    $this->assertTrue(compare1DArrays($C,$this->MLR->getCoefficients()));
  }

  public function testGetPrediction()
  {
    $Z=[[2,3,3],
        [3,4,4]];
    $P=[2.8,4.6];
    $this->assertTrue(compare1DArrays($P,$this->MLR->getPrediction($Z)));
  }

}
