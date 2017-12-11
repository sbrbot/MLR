<?php
namespace StjepanBrbot;

const ε=1E-10;

/**
 * the most rudimentary but optimised Matrix needed for MLR calculation
 * just needed transpose(), multiply() and invert() methods implemented
 */
class Matrix
{
  public $matrix;

  public $rows;
  public $cols;

  public function __construct(array $M)
  {
    $this->matrix=$M;
    $this->rows=count($M);
    $this->cols=count($M[0]);
  }

  public function transpose()
  {
    $T=[];
    foreach($this->matrix as $i=>$r)
    {
      foreach($r as $j=>$val)
      {
        $T[$j][$i]=$val;
      }
    }
    return new self($T);
  }

  public function multiply(Matrix $Y)
  {
    if(!($Y instanceOf self)) throw new InvalidArgumentException('Y must be Matirx object!');
    if($this->cols!=$Y->rows) throw new InvalidArgumentException('Y invalid Matrix object!');

    $M=[];
    for($i=0;$i<$this->rows;$i++)
    {
      for($j=0;$j<$Y->cols;$j++)
      {
        $M[$i][$j]=0;
        for($k=0;$k<$this->cols;$k++)
        {
          $M[$i][$j]+=$this->matrix[$i][$k]*$Y->matrix[$k][$j];
        }
      }
    }
    return new self($M);
  }

  public function invert()
  {
    $I=[];
    $M=$this->matrix;
    $n=$this->rows;

    // augment input matrix with Identity matirx
    for($i=0;$i<$n;$i++)
    {
      for($j=0;$j<$n;$j++)
      {
        $M[$i][$j+$n]=(int)($i==$j);
      }
    }

    // implement Gauss-Jordan elimination
    for($d=0;$d<$n;$d++)
    {
      if(abs($M[$d][$d])<ε)
      {
        // If diagonal element is 0,  then swap this row with another row bellow not having 0 in that column.
        // Throw the the singular matrix exception if all rows bellow have 0 in that column!
        while(abs($M[--$i][$d])<ε) if($i==$d) throw new InvalidArgumentException('Singular matrix!');
        $tmp=$M[$d];$M[$d]=$M[$i];$M[$i]=$tmp;//swap rows in matrix A
      }
      $a=$M[$d][$d];
      for($j=$d;$j<2*$n;$j++)
      {
        $M[$d][$j]/=$a; //normalize row
        if(abs($M[$d][$j])<ε) $M[$d][$j]=0;
      }
      for($i=0;$i<$n;$i++)
      {
        if($a=$M[$i][$d])
        {
          for($j=$d;$j<2*$n;$j++)
          {
            if($i!=$d)
            {
              $M[$i][$j]-=$M[$d][$j]*$a;
              if(abs($M[$i][$j])<ε) $M[$i][$j]=0;
            }
          }
        }
      }
    }

    // extract inverted matrix
    foreach($M as $m) $I[]=array_slice($m,$n);

    return new self($I);
  }

}
