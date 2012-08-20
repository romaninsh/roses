<?php
class Controller_Roses extends AbstractController {
	public $depth=50;

	public $distance=null;

	public $n,$a,$b,$c,$d;



	/**
	 * Calculates total cost of buying $x batches form first and $y from second vendor
	 */
	function getCost($x,$y){
		return $x*$this->b + $y*$this->d;
	}


	/**
	 * $n - Roses we need
	 * $a roses for $b euros
	 * $c roses for $d euros
	 */
	function solve($n,$a,$b,$c,$d){
		return min(
			$this->_solve($n,$a,$b,$c,$d),
			$this->_solve($n,$c,$d,$a,$b)
			);
	}

	function _solve($n,$a,$b,$c,$d){

		list($this->n, $this->a, $this->b, $this->c, $this->d)=
			array($n,$a,$b,$c,$d);

		// We start of by attempting to purchase zero roses from first vendor.
		// We then try several depths of buying more from first vendor to improve result
		$mincost=null;

		for($x=0;$x<$this->depth;$x++){

			// calculate $y
			$y = ceil(($n-$x*$a)/$c);
			$cost=$this->getCost($x,$y);

			if(is_null($mincost) || $cost<$mincost){

				echo "x=$x * ".$this->b." buys us ".($x*$this->a)." roses for ".($x*$this->b).
				" and y=$y * ".$this->d." buys us ".($y*$this->c)." roses for ".($y*$this->d).
				"\n";
			echo "Cost: ".$cost."\n";
			echo "Distance: ".$x."\n";

				$this->distance=$x;

				$mincost=$cost;

			}
		}

		// now, try walking backwards
		$max_x = ceil($n/$a);
		for($x=$max_x;$x>$max_x-$this->depth;$x--){

			// calculate $y
			$y = ceil(($n-$x*$a)/$c);
			$cost=$this->getCost($x,$y);

			if(is_null($mincost) || $cost<$mincost){

				echo "x=$x * ".$this->b." buys us ".($x*$this->a)." roses for ".($x*$this->b).
				" and y=$y * ".$this->d." buys us ".($y*$this->c)." roses for ".($y*$this->d).
				"\n";
			echo "Cost: ".$cost."\n";
			echo "Distance: ".($max_x-$x)."\n";

				$this->distance=$max_x - $x;

				$mincost=$cost;

			}
		}

		return $mincost;

	}
}