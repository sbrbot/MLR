<?php
namespace StjepanBrbot;

use StjepanBrbot\Matrix;

include 'compareArrays.php';

class MatrixTest extends \PHPUnit_Framework_TestCase
{

  private $A=[[0,4,1],
              [4,0,2],
              [2,1,2]];

  protected $M;

  protected function setUp()
  {
    $this->M=new Matrix($this->A);
  }

  protected function tearDown()
  {

  }

  public function testTranspose()
  {
    $T=[[0,4,2],
        [4,0,1],
        [1,2,2]];
    $this->assertTrue(compare2DArrays($T,$this->M->transpose()->matrix));

  }

//  public function testMultiply()
//  {
//    $M=[[]];
//    $this->assertEquals($M,$this->M->invert(),'',0.001);
//  }

  public function testInvert()
  {
    $I=[[1/6,7/12,-2/3],
        [1/3,1/6,-1/3],
        [-1/3,-2/3,4/3]];
    $this->assertTrue(compare2DArrays($I,$this->M->invert()->matrix));
  }

}
