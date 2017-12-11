Multivariate Linear Regression
==============================

This is a simple <b>Multivariate Linear Regression</b> library implemented in PHP.

Using known regression formula: (X<sup>T</sup>X)<sup>-1</sup>X<sup>T</sup>Y it calculates linear coefficients and prediction.

<pre>
require 'MLR.php';

// x1,x2,x3
// input variables (matrix)
$X=[[1,3,3],
    [2,3,1],
    [2,4,2],
    [3,3,4]];

// target variable (vector)
$Y=  [[3],
      [2],
      [4],
      [3]];

// prediction for (matrix)
// x1,x2,x3
$Z=[[2,3,3]];

// instantiate and calculate coefficients
$MLR=new MLR($X,$Y);

// fetch coefficients (if needed)
$Coefficients=$MLR->getCoefficients();

// predict values for given input variable(s)
$Prediction=$MLR->getPrediction($Z);
</pre>

As simple as that!