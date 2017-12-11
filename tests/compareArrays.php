<?php

function compare1DArrays($a,$b)
{
  foreach($a as $i => $val)
  {
    if(abs($val-$b[$i]) > 0.001) return false;
  }
  return true;
}

function compare2DArrays($a,$b)
{
  foreach($a as $i => $array)
  {
    if(!compare1DArrays($array,$b[$i])) return false;
  }
  return true;
}

