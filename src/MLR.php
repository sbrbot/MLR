<?php
namespace StjepanBrbot;

/**
 * Multivariate Linear Regression
 */
class MLR
{
  private $X;//matrix (inputs) - independent vars
  private $Y;//matrix (target) - depentent var
  private $C;//vector (coeffs) - regression coeffs

  public function __construct(array $X,array $Y)
  {
    if(!is_array($X) || !is_array($Y)) throw new InvalidArgumentException('X and Y must be arrays!');
    if(count($X)!=count($Y)) throw new InvalidArgumentException('X and Y not compatible arrays!');
    if(count($Y[0])!=1) throw new InvalidArgumentException('Y must be vector array!');

    //make first column 1
    $A=[];
    for($i=0;$i<count($X);$i++)
    {
      $A[$i][0]=1;
      for($j=1;$j<=count($X[0]);$j++)
      {
        $A[$i][$j]=$X[$i][$j-1];
      }
    }

    $this->X=new Matrix($A);
    $this->Y=new Matrix($Y);

    $T=$this->X->transpose();
    $this->C=$T->multiply($this->X)->invert()->multiply($T->multiply($this->Y));//core
  }

  // return calculated linear coefficients
  public function getCoefficients()
  {
    $C=[];
    for($i=0;$i<$this->C->rows;$i++)
    {
      $C[]=$this->C->matrix[$i][0];
    }
    return $C;
  }

  // make prediction for input values
  public function getPrediction(array $X)
  {
    if(count($X[0])!=($this->C->rows-1)) throw new InvalidArgumentException('Invalid input array!');

    $F=[];
    for($i=0;$i<count($X);$i++)
    {
      $F[$i]=$this->C->matrix[0][0];
      for($j=0;$j<count($X[0]);$j++)
      {
        $F[$i]+=$X[$i][$j]*$this->C->matrix[$j+1][0];
      }
    }
    return $F;
  }
}
